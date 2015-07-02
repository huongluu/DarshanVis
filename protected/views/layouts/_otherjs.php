<script>
    // external js: isotope.pkgd.js

    $(document).ready(function() {
        // init Isotope
        var $container = $('.isotope').isotope({
            itemSelector: '.item',
            layoutMode: 'masonry',
            getSortData: {
                sender: '.crit1',
                date: '.crit2',
                type: '.crit3',
                length: '.crit4'
            }
        });



        $(".sliders").on({
            slide: function() {
            },
            set: function() {
            },
            change: function() {
                var filterValue = $(this).attr('data-filter');
                //                        alert(filterVa)
                // use filterFn if matches value
                //                    filterValue = filterFns[ filterValue ] || filterValue;
                var adad = Math.floor((Math.random() * 7) + 1);
                //                        alert(adad);
                $container.isotope({
                    filter: ".f" + adad
                });
            }
        });

        // bind filter button click
        $('.filters').on('click', 'a', function() {
            var filterValue = $(this).attr('data-filter');
            // use filterFn if matches value
            //                    filterValue = filterFns[ filterValue ] || filterValue;
            $container.isotope({
                filter: filterValue
            });
        });

        $('.chbx').change(function() {
            var filterValue = $(this).attr('data-filter');
            // use filterFn if matches value
            //                    filterValue = filterFns[ filterValue ] || filterValue;
            $container.isotope({
                filter: filterValue
            });
        });

        // bind sort button click
        $('#sorts').on('click', 'button', function() {
            var sortByValue = $(this).attr('data-sort-by');
            $container.isotope({
                sortBy: sortByValue
            });
        });

        // change is-checked class on buttons
        $('.button-group').each(function(i, buttonGroup) {
            var $buttonGroup = $(buttonGroup);
            $buttonGroup.on('click', 'button', function() {
                $buttonGroup.find('.is-checked').removeClass('is-checked');
                $(this).addClass('is-checked');
            });
        });

    });
</script>
<script>
    $('.hideonhover').hover(function() {
        $(this).find('.glyphicon').css('visibility', 'visible');
        ;
    }, function() {
        $(this).find('.glyphicon').css('visibility', 'hidden');
        ;
    });

    $('#datesl').noUiSlider({
        start: [1, 7],
        connect: true,
        range: {
            'min': 1,
            'max': 7
        }
    });
    $("#datesl").Link('upper').to('-inline-<div class="tooltip3"></div>', function(value) {

        // The tooltip HTML is 'this', so additional
        // markup can be inserted here.
        $(this).html(
                '<span>' + value + ' days ago</span>'
                );
    }, wNumb({
        decimals: 0
    }));
    $("#datesl").Link('lower').to('-inline-<div class="tooltip3"></div>', function(value) {
        // The tooltip HTML is 'this', so additional
        // markup can be inserted here.
        $(this).html(
                '<span>' + value + ' days ago</span>'
                );
    }, wNumb({
        decimals: 0
    }));

    $('#comment').noUiSlider({
        start: [0, 200],
        connect: true,
        range: {
            'min': 0,
            'max': 200
        }
    });
    $("#comment").Link('upper').to('-inline-<div class="tooltip2"></div>', function(value) {
        // The tooltip HTML is 'this', so additional
        // markup can be inserted here.
        $(this).html(
                '<span>' + value + '</span>'
                );
    }, wNumb({
        decimals: 0
    }));
    $("#comment").Link('lower').to('-inline-<div class="tooltip2"></div>', function(value) {
        // The tooltip HTML is 'this', so additional
        // markup can be inserted here.
        $(this).html(
                '<span>' + value + '</span>'
                );
    }, wNumb({
        decimals: 0
    }));

    $('#likes').noUiSlider({
        start: [0, 500],
        connect: true,
        range: {
            'min': 0,
            'max': 500
        }
    });
    $("#likes").Link('upper').to('-inline-<div class="tooltip2"></div>', function(value) {
        // The tooltip HTML is 'this', so additional
        // markup can be inserted here.
        $(this).html(
                '<span>' + value + '</span>'
                );
    }, wNumb({
        decimals: 0
    }));
    $("#likes").Link('lower').to('-inline-<div class="tooltip2"></div>', function(value) {
        // The tooltip HTML is 'this', so additional
        // markup can be inserted here.
        $(this).html(
                '<span>' + value + '</span>'
                );
    }, wNumb({
        decimals: 0
    }));

    $('#shares').noUiSlider({
        start: [0, 50],
        connect: true,
        range: {
            'min': 0,
            'max': 50
        }
    });
    $("#shares").Link('upper').to('-inline-<div class="tooltip2"></div>', function(value) {
        // The tooltip HTML is 'this', so additional
        // markup can be inserted here.
        $(this).html(
                '<span>' + value + '</span>'
                );
    }, wNumb({
        decimals: 0
    }));
    $("#shares").Link('lower').to('-inline-<div class="tooltip2"></div>', function(value) {
        // The tooltip HTML is 'this', so additional
        // markup can be inserted here.
        $(this).html(
                '<span>' + value + '</span>'
                );
    }, wNumb({
        decimals: 0
    }));
</script>
<script>
    // Instance the tour
    var tour = new Tour({
        steps: [
            {
                element: "#myfilter",
                title: "Your Feeds",
                content: "You can see your feeds here. They include your favorites feeds, recent feeds and others"
            },
            {
                element: "#myfilter2",
                title: "Your Posts",
                content: "You see your Facebook Posts here, you can filter those using your feeds, also you can sort them using different criteria"
            },
            {
                element: "#myfilter3",
                title: "Create New Feed",
                content: "Here, you can create new feeds using the set of filters."
            },
        ]
    });

    // Initialize the tour
    //            tour.init();

    // Start the tour
    //            tour.start();
</script>