const $container = document.querySelector(`.imageZoom__container`);
const $images = document.querySelectorAll(`.fiche__content--image`);
const $containerImage = document.querySelector(`.imageZoom__image`);
const $close = document.querySelector(`.imageZoom__close`);

$images.forEach($image => {
  $image.addEventListener("click", () => {
    console.log('show');
    $container.style.display = "block";
    $containerImage.setAttribute("src", $image.src);
  });
});



$close.addEventListener("click", () => {
  console.log("close");
  $container.style.display = "none";
});

