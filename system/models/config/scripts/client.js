/*CAMBIA TEMA*/
document.addEventListener("DOMContentLoaded",function(){
//
});
document.addEventListener("DOMContentLoaded",function(event){
const toggleSwitch = document.querySelector('.cambia-tema-label input[type="checkbox"]');
function cambiatema(e) {
  if (e.target.checked) {
    document.documentElement.setAttribute('data-tema', 'scuro');
    localStorage.setItem('tema', 'scuro'); //add this
    document.querySelector('.sole-e-luna').classList.add('luna');
    document.querySelector('.sole-e-luna').classList.remove('sole');
  }
  else {
    document.documentElement.setAttribute('data-tema', 'chiaro');
    localStorage.setItem('tema', 'chiaro'); //add this
    document.querySelector('.sole-e-luna').classList.remove('luna');
    document.querySelector('.sole-e-luna').classList.add('sole');
  }    
}
  
  toggleSwitch.addEventListener('change', cambiatema, false);
  
  const currentTema = localStorage.getItem('tema') ? localStorage.getItem('tema') : null;
  
  if (currentTema) {
    document.documentElement.setAttribute('data-tema', currentTema);
    
    if (currentTema === 'scuro') {
      toggleSwitch.checked = true;
    }
  }
  });
function checksize_at_startup(){
document.addEventListener("DOMContentLoaded",function(event){
var w = window,
d = document,
e = d.documentElement,
b = d.getElementsByTagName('body')[0],
x = w.innerWidth || e.clientWidth || g.clientWidth,
y = w.innerHeight|| e.clientHeight|| g.clientHeight;
if( parseInt(x) < parseInt(1059)){
var ham = document.getElementById("hamburger");
var container = document.getElementsByTagName("header")[0];
var container = container.getElementsByClassName("wrap")[0];
var llogo = document.getElementsByClassName("logo")[0].offsetWidth;
var ham_width = document.getElementById("hamburger").offsetWidth;
var wrapw = container.offsetWidth; wrapw = ((wrapw/2) - ham_width - llogo + 12);
ham.setAttribute("style","margin-left: "+wrapw+"px;");
var ham = document.getElementById("hamburger");
var clone = document.getElementById("GreenGardenTel").cloneNode(true);
clone.setAttribute("id","CloneOfGreenGardenTel");
container.appendChild(clone);
 }else{
if(document.getElementById("CloneOfGreenGardenTel")){
var tel = document.getElementById("CloneOfGreenGardenTel");
document.getElementById("CloneOfGreenGardenTel").parentNode.removeChild(tel);
}
 }
});
 }
 checksize_at_startup();
 function checksize_at_resize(){
var w = window,
 d = document,
 e = d.documentElement,
 b = d.getElementsByTagName('body')[0],
 x = w.innerWidth || e.clientWidth || g.clientWidth,
 y = w.innerHeight|| e.clientHeight|| g.clientHeight;
if( parseInt(x) < parseInt(1059)){
var ham = document.getElementById("hamburger");
var container = document.getElementsByTagName("header")[0];
var container = container.getElementsByClassName("wrap")[0];
var llogo = document.getElementsByClassName("logo")[0].offsetWidth;
var ham_width = document.getElementById("hamburger").offsetWidth;
var wrapw = container.offsetWidth; wrapw = ((wrapw/2) - ham_width - llogo + 12);
ham.setAttribute("style","margin-left: "+wrapw+"px;");
 if(!document.getElementById("CloneOfGreenGardenTel")){
var container = document.getElementsByTagName("header")[0];
var container = container.getElementsByClassName("wrap")[0];
var clone = document.getElementById("GreenGardenTel").cloneNode(true);
clone.setAttribute("id","CloneOfGreenGardenTel");
container.appendChild(clone);
 }
}else{
 var tel = document.getElementById("CloneOfGreenGardenTel");
 document.getElementById("CloneOfGreenGardenTel").parentNode.removeChild(tel);
}}
 window.addEventListener("resize", checksize_at_resize);
 function SmartMenu(){
var hN = document.getElementById("headerNav");
var overlayer = document.getElementById("overlayer");
var bD = document.body;
var html = document.getElementsByTagName("html")[0];
var hM = document.documentElement;
if(hN.getAttribute("class") == "showed"){ 
 hN.removeAttribute("class");
 overlayer.removeAttribute("class");
 bD.removeAttribute("class");
 document.getElementById("hamburger").innerHTML = "&#9776;";
}else{
 hN.setAttribute("class","showed");
 overlayer.setAttribute("class","showed");
 bD.setAttribute("class","NoOverFlow");
 var hei = html.offsetHeight;
 overlayer.setAttribute("style","height:"+hei+"px;");
 document.getElementById("hamburger").innerHTML = "&#10006;";
}
 }
 document.addEventListener("DOMContentLoaded",function(event){
var ham = document.getElementById("hamburger");
ham.addEventListener("click", SmartMenu);
});

