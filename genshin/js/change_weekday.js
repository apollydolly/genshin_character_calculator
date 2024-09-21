document.getElementById('daysOfWeek').addEventListener('change', function() {
  var selectedDay = this.value;
  
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // Получаем ответ от сервера
        var response = xhr.responseText;
        
        // Обновляем содержимое div с картинками
        document.getElementById('imagesContainer').innerHTML = response;
      } else {
        // Обработка ошибок
        console.error('Произошла ошибка при запросе к серверу');
      }
    }
  };

  xhr.open('GET', 'change_talantbooks.php?day=' + selectedDay, true);
  xhr.send();
});