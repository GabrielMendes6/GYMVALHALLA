function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const previewImg = document.getElementById('previewImg');
        previewImg.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}