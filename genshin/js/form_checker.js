function checkform(){
    var tlev = document.querySelector('input[name="tlev"]:checked').value;
    var jlev = document.querySelector('input[name="jlev"]:checked').value;
    var sklev1 = document.getElementById('sklev1').value;
    var sklev2 = document.getElementById('sklev2').value;
    var elev1 = document.getElementById('elev1').value;
    var elev2 = document.getElementById('elev2').value;
    var qlev1 = document.getElementById('qlev1').value;
    var qlev2 = document.getElementById('qlev2').value;
    document.getElementById("result").innerHTML = "";

    var check=0;
    if(sklev1>sklev2){
        check=check+1;
        if(sklev1<10 && sklev2==10){
            check=check-1;
        }
    }
    if(elev1>elev2){
        check=check+1;
    }
    if(qlev1>qlev2){
        check=check+1;
    }
    if(tlev>jlev){
        check=check+1;
    }
    if (check>0){
       document.getElementById('button').disabled = true;
        if(elev2==10 && elev1<10 && elev1>1){
        check=check-1;
        document.getElementById('button').disabled = false;
        }
        if(qlev2==10 && qlev1<10 && qlev1>1){
        check=check-1;
        document.getElementById('button').disabled = false;
        }
    }
    else{
        document.getElementById('button').disabled = false;
        if(sklev1==10 && sklev2<10){
        check=check+1;
        document.getElementById('button').disabled = true;
        }
        if(elev1==10 && elev2<10){
        check=check+1;
        document.getElementById('button').disabled = true;
        }
        if(qlev1==10 && qlev2<10){
        check=check+1;
        document.getElementById('button').disabled = true;
        }
    }
}