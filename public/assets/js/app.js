 document.addEventListener('DOMContentLoaded', () => {

            const button = document.getElementById('userDropdown');
            const menu = document.getElementById('userMenu');

            button.addEventListener('click', (event) => {

                event.preventDefault();

                menu.style.display =
                    menu.style.display === 'block'
                        ? 'none'
                        : 'block';

            });

            document.addEventListener('click', (event) => {

                if (!button.contains(event.target) && !menu.contains(event.target)) {

                    menu.style.display = 'none';

                }

            });

        });

$(function() {
            var selectedClass = "";
            $("p").click(function(){
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("."+selectedClass).fadeOut();
            setTimeout(function() {
              $("."+selectedClass).fadeIn();
              $("#portfolio").fadeTo(50, 1);
            }, 500);
                
            });
        });