class WoodenHouse {
  openDoor() {
    return 'Opening wooden door…';
  }
}
class SmartHouse {
  openDoor() {
    return 'Scanning fingerprint, door opened!';
  }
}

let houses = [new WoodenHouse(), new SmartHouse()];
houses.forEach(h => console.log(h.openDoor()));

// alert("Selamat Datang!");

// let nama = prompt("Siapa nama kamu?");
// alert("Halo " + nama);


let umur = 18;
if(umur>=17){
    console.log("Boleh KTP");
}else{
    console.log("Tidak Boleh KTP");
}

for(let i=1; i<=5; i++){
    console.log(i);
}

document.getElementById('judul').style.fontSize=35;
// Event Listener click, ketik, scroll, dll
document.getElementById('btn').addEventListener("click",function(){
    console.log("BUTTON CLICK");
});