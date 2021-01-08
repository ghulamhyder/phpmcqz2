

let x=document.querySelector('.mytime');

/*function myfunc(i){
  if(i<10){
   i='0'+i;
  }
  return i;
}

function mytime(){
let year=myfunc(y.getFullYear());
let month=y.getMonth();
month++;

let month1=myfunc(month);

let date=myfunc(y.getDate());
x.innerHTML=date+'-'+month1+'-'+year;

}*/

let hr=0;
let min=0;
let sec=0;

function myfunc(i){
  
  if(i<10){
    i='0'+i;
  }
  return i;
}
function mytime(){
sec++;
/*let y=new Date();
let h=myfunc(y.getHours());
let min=myfunc(y.getMinutes());
let sec=myfunc(y.getSeconds());*/
let hr1=myfunc(hr);
let min1=myfunc(min);
let sec1=myfunc(sec);
if(sec1>58){
  min++;
  sec=0;
  
}
if(min1>58){
 hr++;
 min=0;
 
}
x.innerHTML=hr1+':'+min1+':'+sec1;
setTimeout(mytime,1000);

}
mytime();


