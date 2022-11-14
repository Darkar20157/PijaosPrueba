function getImage(event){
    let img = URL.createObjectURL(event.target.files[0]);
    let imagediv = document.querySelector(".preview");
    let newimg = document.createElement('img');
    imagediv.innerHTML = "";
    newimg.src = img;
    newimg.className = "img-photo";
    imagediv.appendChild(newimg);
}