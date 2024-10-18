function refresh_image() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("image").files[0]);

    oFReader.onload = function (oFREvent) 
    {
        document.getElementById("image_preview").src = oFREvent.target.result;
    }
}