<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/cse/css/cse.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        /// some script
        // jquery ready start
        $(document).ready(function () {
            // jQuery code

            //////////////////////// Prevent closing from click inside dropdown
            $(document).on('click', '.dropdown-menu', function (e) {
                e.stopPropagation();
            });

            // make it as accordion for smaller screens
            if ($(window).width() < 992) {
                $('.dropdown-menu a').click(function (e) {
                    e.preventDefault();
                    if ($(this).next('.submenu').length) {
                        $(this).next('.submenu').toggle();
                    }
                    $('.dropdown').on('hide.bs.dropdown', function () {
                        $(this).find('.submenu').hide();
                    })
                });
            }
            
            $(window).scroll(function(){
                // console.log($(window).scrollTop());
                if($(window).scrollTop() > 100){
                  
                    $(".navbar").addClass("navbar-onscroll");
                }
                else {
                    $(".navbar").removeClass("navbar-onscroll");
                }
                $('.scrollanimate').each(function() {
                    if ($(this)[0].getBoundingClientRect().top < 1000){
                        $(this).addClass("scrollanimate-show");
                    }
                });
            })

            // $('.scrollanimate').waypoint(function() {
            //     alert('You have scrolled to an entry.');
            // });

    
        }); // jquery end
    </script>
</head>



<body>
@include('cse.layout.header')
@yield('body')
</body>
<footer>
 @include('cse.layout.footer')
</footer>

</html>