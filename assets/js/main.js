$(document).ready(function() {

    /* gsap functionality */
    var tl = gsap.timeline();
    tl.to('ul.transition li', { duration: .5, scaleY: 1, transformOrigin: "bottom left", stagger: .2 });
    tl.to('ul.transition li', { duration: .5, scaleY: 0, transformOrigin: "bottom left", stagger: .1, delay: .1 });
    /* sal js config */
    setTimeout(() => {
        sal({
            threshold: 0.1,
            once: true,
        });

    }, 2000);

    /* skill bar config */
    var detectWindow = $(window).width();
    if (detectWindow > 767) {
        $('.tech').mouseover(function() {
            $('.skillbar').skillbar({
                speed: 1500
            });

        });

    } else {
        $('.skillbar').skillbar({
            speed: 1500
        });

    }

    /* loadmore config */
    $('.some-list').simpleLoadMore({
        count: 8,
        item: 'div',
        btnHTML: '<a href="#" class="load-more__btn">Load More <i class="fas fa-angle-down"></i></a>'
    });
    /* contact form validation */

    $.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            var check = false;
            return this.optional(element) || regexp.test(value);
        }
    );

    $("#contact-form").validate({
        // Specify validation rules
        rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            name: {
                required: true,
                regex: /^[a-zA-Z\s]*$/,

            },
            email: {
                required: true,
                // Specify that email should be validated
                // by the built-in "email" rule
                email: true,
                regex: /^([\w-.]+@(gmail|yahoo|hotmail|pacewisdom|rediffmail)(\.+)?[a-zA-Z])\/?/,
            },
            message: "required",
        },
        // Specify validation error messages
        messages: {
            name: {
                required: "Please enter your Name",
                regex: "Please enter a valid Name ",
            },
            email: {
                required: "Please enter your email",
                regex: "Please enter a Valid Email",
            },
            message: "Please enter your message",
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form) {
            form.submit();
        }
    });
    /* implementing gsap animation */
    // gsap.from('.about-me', { opacity: 0, duration: 1, y: -100, ease: 'Power2.easeInOut' });
    // gsap.from('.name', { opacity: 0, duration: 1, y: -30 });
    /* toggle switch functionality */
    $("input[name='checkbox']").click(function() {

        if ($(this).is(":checked")) {
            localStorage.setItem("check", $(this).val());
            $('body').addClass('add_bg');
            $('.toggle-color').addClass('white-black');
            $('.change-color').css('color', '#fff');
            $('.hide-logo').css('display', 'none');
            $('.show-logo').css('display', 'block');
            $('.pad-top').css('visibility', 'hidden');
            $('.profile-pic').css('filter', 'saturate(100%)');
        } else {
            localStorage.removeItem("check");
            $('body').removeClass('add_bg');
            $('.toggle-color').removeClass('white-black');
            $('.change-color').css('color', '#ad3133');
            $('.pad-top').css('visibility', 'visible');
            $('.hide-logo').css('display', 'block');
            $('.show-logo').css('display', 'none');
            $('.profile-pic').css('filter', 'grayscale(100%)');
        }

    });
    var data = localStorage.getItem("check");

    if (data !== null) {
        $("input[name='checkbox']").attr("checked", "checked");
        $('body').addClass('add_bg');
        $('.toggle-color').addClass('white-black');
        $('.change-color').css('color', '#fff');
        $('.pad-top').css('visibility', 'hidden');
        $('.profile-pic').css('filter', 'saturate(100%)');
    }
    /* onscroll fix toggle switch functionality */
    $(document).scroll(function() {
        if ($(this).scrollTop() > 500) {
            $('.toggle-switch').addClass('onscroll-fix');
            $('.fix-title').fadeIn(300);
            $('.fix-title').addClass('onscroll-fix-title');
        } else {
            $('.toggle-switch').removeClass('onscroll-fix');
            $('.fix-title').css('display', 'none');
            $('.fix-title').removeClass('onscroll-fix-title');

        }

    });
    $('.scroll-to-top').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 1400);

    });
});