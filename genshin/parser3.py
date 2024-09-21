import requests
from bs4 import BeautifulSoup
from mysql.connector import connect, Error
import ast

headers = {
    "user-agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) "
                  "Chrome/123.0.0.0 Safari/537.36 "
}


def get_items(url):
    req = requests.get(url, headers)

    with open(f"html_files/{url.split('/')[-2]}.html", "w", encoding="utf-8") as file:
        file.write(req.text)

    with open(f"html_files/{url.split('/')[-2]}.html", encoding="utf-8") as file:
        src = file.read()

    soup = BeautifulSoup(src, "lxml")
    items = soup.find_all("div", class_="itemList__item")

    # print(characters)
    items_names = []
    items_links = []
    items_imgs = []
    for item in items:
        name = item.find("div", class_="itemcard__imgName").text
        link = "https://genshin-info.ru" + item.find("a", class_="itemcard").get("href")
        img = "https://genshin-info.ru/" + item.find("img", class_="lazyload").get("data-src")
        items_links.append(link)
        items_names.append(name)
        items_imgs.append(img)

    return items_names, items_imgs, items_links


def get_material_data(url):
    # print(url)
    req = requests.get(url, headers)

    with open(f"html_files/materials/{url.split('/')[-2]}.html", "w", encoding="utf-8") as file:
        file.write(req.text)

    with open(f"html_files/materials/{url.split('/')[-2]}.html", encoding="utf-8") as file:
        src = file.read()

    soup = BeautifulSoup(src, "lxml")
    divs = soup.find_all("div", class_="card")
    links = divs[7].find_all("a")

    material_name = divs[6].find("div", class_="itemcard__imgName").text
    print(material_name)

    cursor = con.cursor()
    cursor.execute(f"SELECT idmaterial FROM `material` WHERE title = (%s)", [material_name])
    material_id = str(cursor.fetchall())[2:-3]

    if material_name in ['Опыт героя', 'Опыт искателя приключений', 'Опыт странника', 'Мора']:
        cursor.execute(f"SELECT idcharacter FROM `character`")
        # characters_id = cursor.fetchall()
        # characters_id = [t[0] for t in ast.literal_eval(str(characters_id))]
        # for character_id in characters_id:
        #     cursor.executemany("INSERT IGNORE INTO `character_has_material` (character_idcharacter, "
        #                        "material_idmaterial) VALUES (%s, %s)", list(zip([character_id], [material_id])))
        #     con.commit()

    else:
        if divs[7].find("h2").get("id") == "chars":
            names = []
            for link in links:
                name = link.get("title")
                names.append(name)
            placeholders = ', '.join(['%s'] * len(names))
            cursor.execute(f"SELECT idcharacter FROM `character` WHERE name IN ({placeholders})", names)

    characters_id = cursor.fetchall()
    characters_id = [t[0] for t in ast.literal_eval(str(characters_id))]
    for character_id in characters_id:
        cursor.executemany(
            "INSERT IGNORE INTO `character_has_material` (idcharacter, idmaterial) VALUES (%s, %s)",
            list(zip([character_id], [material_id])))
        con.commit()


def get_map(url):
    with open(f"html_files/materials/{url.split('/')[-2]}.html", encoding="utf-8") as file:
        src = file.read()

    soup = BeautifulSoup(src, "lxml")
    divs = soup.find_all("div", class_="card")
    material_name = divs[6].find("div", class_="itemcard__imgName").text
    print(material_name)
    res = 0

    for div in divs:
        try:
            if div.find("h2").text == "Интерактивная карта":
                cursor = con.cursor()
                cursor.execute(
                    "UPDATE `material` SET location = %s WHERE title = %s", [url + "#map", material_name])
                con.commit()
                res = 1
                break
        except AttributeError:
            continue

    if res == 0:
        for div in divs:
            try:
                if div.find("h2").text == "Список боссов" or div.find("h2").text == "Обычные и элитные враги" or \
                        div.find("h2").text == "Подземелья" or div.find("h2").text == "Артерии земли":
                    res_div = div.find("h2").text
                    links = div.find_all("a")
                    for link in links:
                        url2 = "https://genshin-info.ru" + link.get("href")
                        req2 = requests.get(url2, headers)

                        with open(f"html_files/materials/map/{url2.split('/')[-2]}.html", "w",
                                  encoding="utf-8") as file2:
                            file2.write(req2.text)

                        with open(f"html_files/materials/map/{url2.split('/')[-2]}.html", encoding="utf-8") as file2:
                            src2 = file2.read()

                        soup2 = BeautifulSoup(src2, "lxml")
                        divs = soup2.find_all("div", class_="card")
                        if url2 != "https://genshin-info.ru/wiki/torgovtsy/starina-chzhou/":
                            for div in divs:
                                try:
                                    if div.find("h2").text == "Интерактивная карта":
                                        cursor = con.cursor()
                                        cursor.execute(
                                            "UPDATE `material` SET location = %s WHERE title = %s AND location IS NULL",
                                            [url2 + "#map", material_name])
                                        con.commit()
                                        res = 1
                                        break
                                except AttributeError:
                                    continue
                    if res == 0:
                        if res_div == "Подземелья":
                            cursor = con.cursor()
                            cursor.execute(
                                "UPDATE `material` SET location = %s WHERE title = %s",
                                [url + "#dungeon", material_name])
                            con.commit()
                            res = 1
                            break
                        elif res_div == "Артерии земли":
                            cursor = con.cursor()
                            cursor.execute(
                                "UPDATE `material` SET location = %s WHERE title = %s",
                                [url + "#arteries", material_name])
                            con.commit()
                            res = 1
                            break
                        else:
                            cursor = con.cursor()
                            cursor.execute(
                                "UPDATE `material` SET location = %s WHERE title = %s",
                                [url + "#bosses", material_name])
                            con.commit()
                            res = 1
                            break
                elif material_name == "Корона прозрения":
                    cursor = con.cursor()
                    cursor.execute(
                        "UPDATE `material` SET location = %s WHERE title = %s",
                        [url + "#vendors", material_name])
                    con.commit()
                    res = 1
                    break
            except AttributeError:
                continue


def get_weekday(name, days1, days2, days3):
    cursor = con.cursor()
    cursor.execute("SELECT idmaterial FROM material WHERE title=%s", [name])
    idmaterial = str(cursor.fetchall())[2:-3]
    ids = []
    if name in days1:
        cursor.execute("SELECT idweekday FROM weekday WHERE name IN ('Понедельник', 'Четверг')")
        ids = [t[0] for t in ast.literal_eval(str(cursor.fetchall()))]
    if name in days2:
        cursor.execute("SELECT idweekday FROM weekday WHERE name IN ('Вторник', 'Пятница')")
        ids = [t[0] for t in ast.literal_eval(str(cursor.fetchall()))]
    if name in days3:
        cursor.execute("SELECT idweekday FROM weekday WHERE name IN ('Среда', 'Суббота')")
        ids = [t[0] for t in ast.literal_eval(str(cursor.fetchall()))]

    cursor.execute("SELECT idweekday FROM weekday WHERE name='Воскресенье'")
    sun_id = int(str(cursor.fetchall())[2:-3])
    ids.append(sun_id)
    for day_id in ids:
        cursor.execute("INSERT IGNORE INTO material_has_weekday VALUES(%s, %s)", (idmaterial, day_id))
    con.commit()


def update_materials():
    names = []
    imgs = []
    links = []
    names7, imgs7, links7 = get_items("https://genshin-info.ru/wiki/predmety/osobye-predmety/")
    for search_string in ["Опыт героя", "Опыт искателя приключений", "Опыт странника"]:
        for index, item in enumerate(names7):
            if item == search_string:
                names.append(names7[index])
                imgs.append(imgs7[index])
                links.append(links7[index])
    names1, imgs1, links1 = get_items("https://genshin-info.ru/wiki/predmety/dikoviny/")
    names.extend(names1)
    imgs.extend(imgs1)
    links.extend(links1)
    names2, imgs2, links2 = get_items(
        "https://genshin-info.ru/wiki/predmety/uluchshenie-personazhey-i-oruzhiya/materialy-vozvysheniya-personazha/")
    names.extend(names2)
    imgs.extend(imgs2)
    links.extend(links2)
    names3, imgs3, links3 = get_items(
        "https://genshin-info.ru/wiki/predmety/uluchshenie-personazhey-i-oruzhiya/kristally/")
    names.extend(names3)
    imgs.extend(imgs3)
    links.extend(links3)
    names4, imgs4, links4 = get_items(
        "https://genshin-info.ru/wiki/predmety/uluchshenie-personazhey-i-oruzhiya/obychnye-materialy-uluchsheniya/")
    names.extend(names4)
    imgs.extend(imgs4)
    links.extend(links4)
    names5, imgs5, links5 = get_items(
        "https://genshin-info.ru/wiki/predmety/uluchshenie-personazhey-i-oruzhiya/materialy-dlya-povysheniya-urovnya"
        "-navykov/")
    names.extend(names5)
    imgs.extend(imgs5)
    links.extend(links5)
    names6, imgs6, links6 = get_items(
        "https://genshin-info.ru/wiki/predmety/uluchshenie-personazhey-i-oruzhiya/materialy-s-ezhenedelnykh-bossov/")
    names.extend(names6)
    imgs.extend(imgs6)
    links.extend(links6)
    for index, item in enumerate(names7):
        if item == "Мора":
            names.append(names7[index])
            imgs.append(imgs7[index])
            links.append(links7[index])
    names_imgs = list(zip(names, imgs))
    cursor = con.cursor()
    cursor.execute("SELECT COUNT(*) FROM `material`")
    res = int(str(cursor.fetchall())[2:-3])
    if len(names_imgs) > res:
        cursor.executemany("INSERT IGNORE INTO `material` (title, url_image) VALUES (%s, %s)", names_imgs)
        con.commit()
    cursor.execute("SELECT * FROM `material`")
    res2 = cursor.fetchall()
    print(res2)
    print("Материалы успешно заполнены!")

    c = 0
    for link in links:
        c = c + 1
        get_material_data(link)
        get_map(link)
    print("Информация о ", c, " материалах успешно заполнена!")

    days_of_week = ["Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье"]
    for day in days_of_week:
        cursor.executemany("INSERT IGNORE INTO weekday (name) VALUES (%s)", [(day,)])
    con.commit()

    url = "https://genshin-impact.fandom.com/ru/wiki/Материалы_талантов_персонажей#Книги_талантов"
    req = requests.get(url, headers)

    with open(f"html_files/weekdays.html", "w", encoding="utf-8") as file:
        file.write(req.text)

    with open(f"html_files/weekdays.html", encoding="utf-8") as file:
        src = file.read()

    soup = BeautifulSoup(src, "lxml")
    tables = soup.find_all("table", class_="wikitable")
    i = 0
    days1 = []
    days2 = []
    days3 = []
    for table in tables:
        trs = table.find_all("tr")
        for tr in trs:
            tds = tr.find_all("td")
            # for td in tds:
            for i in range(len(tds)):
                if "ПН, ЧТ" in tds[i].get_text():
                    days1.extend([tds[i + 1].find("a").get("title"), tds[i + 2].find("a").get("title"),
                                  tds[i + 3].find("a").get("title")])
                if "ВТ, ПТ" in tds[i].get_text():
                    days2.extend([tds[i + 1].find("a").get("title"), tds[i + 2].find("a").get("title"),
                                  tds[i + 3].find("a").get("title")])
                if "СР, СБ" in tds[i].get_text():
                    days3.extend([tds[i + 1].find("a").get("title"), tds[i + 2].find("a").get("title"),
                                  tds[i + 3].find("a").get("title")])

    for name in names5[1:]:
        get_weekday(name, days1, days2, days3)

    cursor.execute("SELECT idcharacter FROM `character`")
    characters = [t[0] for t in ast.literal_eval(str(cursor.fetchall()))]

    for character in characters:
        cursor.execute("SELECT COUNT(*) FROM material INNER JOIN character_has_material ON "
                       "material.idmaterial=character_has_material.idmaterial "
                       "INNER JOIN `character` ON character_has_material.idcharacter=character.idcharacter WHERE "
                       "character.idcharacter=(%s)",
                       [character])
        res = int(str(cursor.fetchall())[2:-3])
        if res != 18:
            cursor.execute("DELETE FROM `character` where idcharacter=(%s)", [character])
            con.commit()


def update_characters():
    names, imgs, links = get_items("https://genshin-info.ru/wiki/personazhi/")
    names_imgs = list(zip(names, imgs))
    cursor = con.cursor()
    cursor.execute("SELECT COUNT(*) FROM `character`")
    res = int(str(cursor.fetchall())[2:-3])
    if len(names_imgs) > res:
        cursor.executemany("INSERT IGNORE INTO `character` (name, url_image) VALUES (%s, %s)", names_imgs)
        con.commit()
    cursor.execute("SELECT * FROM `character`")
    res2 = cursor.fetchall()
    print(res2)
    print("Персонажи успешно заполнены!")


try:
    global con
    con = connect(host="localhost", user="root", password="12345", database="genshin_db")
    print("Соединение с БД", con)
    update_characters()
    update_materials()

except Error as e:
    print("Ошибка соединения!", str(e))
