//switches pfp icon colors when user selects an option
var book;
var daggers;
var dragon;
var drama;
var fire;
var hammer;
var knife;
var mace;
var raven;
var shield;
var sword;
var tools;
var typewriter;
var wand;

var icons = [book, daggers, dragon, drama, fire, hammer, knife, mace, raven, shield, sword, tools, typewriter, wand];

var shade0;
var shade1;
var shade2;
var shade3;
var shade4;
var shade5;
var shade6;
var shade7;
var shade8;
var shade9;
var shade10;
var shade11;
var shade12;
var shade13;
var shade14;
var shade15;
var shade16;
var shade17;
var shade18;
var shade19;
var shade20;
var shade21;
var shade22;
var shade23;
var shade24;
var shade25;
var shade26;
var shade27;
var shade28;
var shade29;
var shade30;
var shade31;
var shade32;
var shade33;
var shade34;

var shades = [];

window.onload = function() {
book = document.getElementById("book-n-quill");
daggers = document.getElementById("daggers");
dragon = document.getElementById("dragon");
drama = document.getElementById("drama");
fire = document.getElementById("fire");
hammer = document.getElementById("hammer");
knife = document.getElementById("knife");
mace = document.getElementById("mace");
raven = document.getElementById("raven");
shield = document.getElementById("shield");
sword = document.getElementById("sword");
tools = document.getElementById("tools");
typewriter = document.getElementById("typewriter");
wand = document.getElementById("wand");

shade0 = document.getElementById("color-0");shades.push(shade0);
shade1 = document.getElementById("color-1");shades.push(shade1);
shade2 = document.getElementById("color-2");shades.push(shade2);
shade3 = document.getElementById("color-3");shades.push(shade3);
shade4 = document.getElementById("color-4");shades.push(shade4);
shade5 = document.getElementById("color-5");shades.push(shade5);
shade6 = document.getElementById("color-6");shades.push(shade6);
shade7 = document.getElementById("color-7");shades.push(shade7);
shade8 = document.getElementById("color-8");shades.push(shade8);
shade9 = document.getElementById("color-9");shades.push(shade9);
shade10 = document.getElementById("color-10");shades.push(shade10);
shade11 = document.getElementById("color-11");shades.push(shade11);
shade12 = document.getElementById("color-12");shades.push(shade12);
shade13 = document.getElementById("color-13");shades.push(shade13);
shade14 = document.getElementById("color-14");shades.push(shade14);
shade15 = document.getElementById("color-15");shades.push(shade15);
shade16 = document.getElementById("color-16");shades.push(shade16);
shade17 = document.getElementById("color-17");shades.push(shade17);
shade18 = document.getElementById("color-18");shades.push(shade18);
shade19 = document.getElementById("color-19");shades.push(shade19);
shade20 = document.getElementById("color-20");shades.push(shade20);
shade21 = document.getElementById("color-21");shades.push(shade21);
shade22 = document.getElementById("color-22");shades.push(shade22);
shade23 = document.getElementById("color-23");shades.push(shade23);
shade24 = document.getElementById("color-24");shades.push(shade24);
shade25 = document.getElementById("color-25");shades.push(shade25);
shade26 = document.getElementById("color-26");shades.push(shade26);
shade27 = document.getElementById("color-27");shades.push(shade27);
shade28 = document.getElementById("color-28");shades.push(shade28);
shade29 = document.getElementById("color-29");shades.push(shade29);
shade30 = document.getElementById("color-30");shades.push(shade30);
shade31 = document.getElementById("color-31");shades.push(shade31);
shade32 = document.getElementById("color-32");shades.push(shade32);
shade33 = document.getElementById("color-33");shades.push(shade33);
shade34 = document.getElementById("color-34");shades.push(shade34);

}

// document.onclick = function(e) {
//   var iconId = e.target.id;
//   console.log("clicked");
//   console.log(shades.length);
  
//   var shadesBox = document.getElementById("color-preview");
//   shadesBox.style.display = "block";
  
//   for (i = 0; i < shades.length; i++) {
//     console.log("thing");
//     var m_imageSrc = "images/" + iconId + "/" + iconId + " (" + i + ").png";
//     console.log(m_imageSrc);
//     shades[i].src = m_imageSrc;
//   }
// }

function getImageSrc() {
  var iconId = target.id;
  console.log("clicked");
  console.log(shades.length);
  
  var shadesBox = document.getElementById("color-preview");
  shadesBox.style.display = "block";
  
  for (i = 0; i < shades.length; i++) {
    console.log("thing");
    var m_imageSrc = "images/" + iconId + "/" + iconId + " (" + i + ").png";
    console.log(m_imageSrc);
    shades[i].src = m_imageSrc;
  }
}