<script>

document.addEventListener("DOMContentLoaded", function () {

    if (typeof gsap === "undefined") {
        return;
    }


    /*
    ==========================================
    CINEMATIC SLOW MOTION
    ==========================================
    */

    const hero = document.querySelector(".create-hero");
    const formInfo = document.querySelector(".form-info");
    const formCard = document.querySelector(".form-card");


    /*
    HERO
    */

    if (hero) {

        gsap.to(hero, {
            opacity: 1,
            y: 0,

            duration: 1.8,

            ease: "power4.out"
        });

    }


    /*
    LEFT INFORMATION
    */

    if (formInfo) {

        gsap.to(formInfo, {

            opacity: 1,
            y: 0,

            duration: 1.6,

            delay: 0.35,

            ease: "power4.out"

        });

    }


    /*
    FORM CARD
    */

    if (formCard) {

        gsap.to(formCard, {

            opacity: 1,
            y: 0,

            duration: 1.8,

            delay: 0.55,

            ease: "power4.out"

        });

    }


    /*
    INPUT REVEAL
    */

    gsap.utils.toArray(".input-group").forEach(function (input, index) {

        gsap.from(input, {

            opacity: 0,

            y: 35,

            duration: 1.3,

            delay: 0.9 + (index * 0.15),

            ease: "power3.out"

        });

    });


    /*
    BUTTON
    */

    const button = document.querySelector(".save-button");

    if (button) {

        gsap.from(button, {

            opacity: 0,

            y: 25,

            duration: 1.2,

            delay: 1.9,

            ease: "power3.out"

        });

    }


    /*
    MAGNETIC BUTTON
    */

    const magneticButtons =
        document.querySelectorAll(".magnetic-btn");


    magneticButtons.forEach(function (button) {

        const moveX = gsap.quickTo(button, "x", {
            duration: 0.7,
            ease: "power3.out"
        });

        const moveY = gsap.quickTo(button, "y", {
            duration: 0.7,
            ease: "power3.out"
        });


        button.addEventListener("mousemove", function (e) {

            const rect =
                button.getBoundingClientRect();

            const x =
                e.clientX -
                (rect.left + rect.width / 2);

            const y =
                e.clientY -
                (rect.top + rect.height / 2);


            moveX(x * 0.18);
            moveY(y * 0.18);

        });


        button.addEventListener("mouseleave", function () {

            moveX(0);
            moveY(0);

        });

    });

});

</script>
