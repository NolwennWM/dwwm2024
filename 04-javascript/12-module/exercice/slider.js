"use strict";


export function createSlider(imagesPaths)
{
    const sliderContainer = document.createElement("div");
    sliderContainer.classList.add("slider-container");

    const slider = document.createElement("div");
    slider.classList.add("slider");

    slider.append(document.querySelector(".slider-controls"));

    const btnsContainer = document.createElement("div");
    btnsContainer.classList.add("btns-container");

    imagesPaths.forEach((path, index) => {
        const img = document.createElement("img");
        img.src = path;
        slider.appendChild(img);
        const b = document.createElement("button");
        btnsContainer.append(b);
        b.classList.add("btns");
        b.append(img.cloneNode());
        b.dataset.id = index;
    });
    sliderContainer.append(slider, btnsContainer);
    return sliderContainer;
}

export function Ss()
{
    const slider = document.querySelector(".slider");
    const images = slider.querySelectorAll("img");
    const b = document.querySelectorAll(".btns");

    let currentIndex = 0;

    function showImage(index)
    {
        images.forEach((img, i)=>{
            if(i === index)
            {
                img.style.display = "block";
            }
            else
            {
                img.style.display = "none";
            }
        });
    }
    function nextImage()
    {
        currentIndex = (currentIndex + 1) % images.length;
        showImage(currentIndex);
    }
    function prevImage()
    {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        showImage(currentIndex);
    }
    document.querySelectorAll(".btns").forEach(button=>{
        button.addEventListener("click", function(){
            const imageId = parseInt(this.dataset.id);
            showImage(imageId);
            document.querySelectorAll("button").forEach(btn=>{
                btn.style.filter = "none";
            });
            this.style.filter = "hue-rotate(120deg) saturate(2000%)";
        });
    });
    showImage(currentIndex);
    document.querySelector(".prev").addEventListener("click", prevImage);
    document.querySelector(".next").addEventListener("click", nextImage);

    let inter;

    document.querySelector(".img").addEventListener("click", play);

    function play()
    {
        if(!inter)
        {
            inter = setInterval(nextImage, 1000);
        }
        else
        {
            clearInterval(inter);
            inter = null;
        }
    }
}

