/*

Template: COINEX - Crypto Currency HTML Template 
Author: iqonicthemes.in
Version: 2.0

*/

/*----------------------------------------------
Index Of Script
------------------------------------------------

1.Page Loader
2.Back To Top
3.Charts
4.Header
5.Jarallax
6.Searchstyle Bar
7.Progress Bar
8.Magnific Popup
9.Countdown
10.widget
11.counter
12.Wow Animation
13.Owl Carousel
14.Contact from

------------------------------------------------
Index Of Script
----------------------------------------------*/

$(document).ready(function() {

  /*------------------------
  Page Loader
  --------------------------*/
  const loading = document.getElementById("loading")
  if (loading !== null && loading !== undefined) {
    jQuery("#load").fadeOut();
    jQuery("#loading").delay(0).fadeOut("slow");
  }
  /*------------------------
  Back To Top
  --------------------------*/
  const backToTop = document.getElementById("back-to-top")
  if (backToTop !== null && backToTop !== undefined) { 
    $('#back-to-top').fadeOut();
    $(window).on("scroll", function() {
        if ($(this).scrollTop() > 250) {
            $('#back-to-top').fadeIn(1400);
        } else {
            $('#back-to-top').fadeOut(400);
        }
    });
    // scroll body to 0px on click
    $('#top').on('click', function() {
      $('top').tooltip('hide');
      $('body,html').animate({
        scrollTop: 0
      }, 800);
      return false;
    });
  }

  /*------------------------
  Charts
  --------------------------*/
  (function(b,i,t,C,O,I,N) {
    window.addEventListener('load',function() {
      if(b.getElementById(C))return;
      I=b.createElement(i),N=b.getElementsByTagName(i)[0];
      I.src=t;I.id=C;N.parentNode.insertBefore(I, N);
    },false)
  });
  // (document,'script','https://widgets.bitcoin.com/widget.js','btcwdgt')
  /*------------------------
  apex Charts
  --------------------------*/

  if(jQuery("#chart-01").length){
      var options = {
        series: [{
        name: 'Sales',
        data: [40, 50, 40, 70, 70, 60, 60,80,90,90,85,90]
      },
      {
      name: 'Orders',
      data: [40, 50, 40, 70, 70, 60, 60,80,90,90,85,90]
      }],
      colors: ['#f4f4f4','#f9b707'],
      fill: {
          type: 'gradient',
          gradient: {
            opacityFrom: 0.91,
            opacityTo: 0.1,
          }
        },
        chart: {
        height: 400,
        fontFamily: 'DM Sans',
        toolbar:{
          show: false,
        },
        type: 'area'
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        width: 2
      },
      yaxis: {
        labels: {
        offsetY:0,
        minWidth: 20,
        maxWidth: 20
        },
      },
      xaxis: {
        labels: {
          minHeight: 20,
          maxHeight: 20
        },
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','July','Aug','Sep','Oct','Nov','Dec'],        
      },
      legend: {
          position: 'top',
          horizontalAlign: 'right',
          offsetX: -33
        }
      };

      var chart = new ApexCharts(document.querySelector("#chart-01"), options);
      chart.render();
  }
  if (jQuery("#chart-02").length) {
  var options = {
        series: [{
          name: "Desktops",
          data: [5, 30, 6, 20, 5, 18, 10]
      }],
      colors: ['#4e37b2'],
        chart: {
        height: 60,
        width: 100,
        type: 'line',
        zoom: {
          enabled: false
        },
        sparkline: {
        enabled: true,
      }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 3
      },
      title: {
        text: '',
        align: 'left'
      },
      grid: {
        row: {
          colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
          opacity: 0.5
        },
      },
      xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
      }
      };

      var chart = new ApexCharts(document.querySelector("#chart-02"), options);
      chart.render();
}
  if(jQuery("#chart-03").length){
      
     
      var options = {
        series: [{
        name: 'Sales',
        data: [31, 40, 28, 51, 42, 109, 100]
      }, {
        name: 'Orders',
        data: [11, 32, 45, 32, 34, 52, 41]
      }],
            colors: ['#f9b707','#27b345'],

        chart: {
        height: 400,
        type: 'area',
        toolbar:{
              show: false,
            },
            zoom: {
          enabled: false
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth'
      },
      xaxis: {
        type: 'datetime',
        categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
      },
      legend: {
            position: 'top',
            horizontalAlign: 'right',
            offsetX: -33
          },
      tooltip: {
        x: {
          format: 'dd/MM/yy HH:mm'
        },
      },
      };

      var chart = new ApexCharts(document.querySelector("#chart-03"), options);
      chart.render();
    
    
  
  }
   if (jQuery("#chart-04").length) {
        var options = {
          series: [{
          data: [{
              x: new Date(1538778600000),
              y: [6629.81, 6650.5, 6623.04, 6633.33]
            },
            {
              x: new Date(1538780400000),
              y: [6632.01, 6643.59, 6620, 6630.11]
            },
            {
              x: new Date(1538782200000),
              y: [6630.71, 6648.95, 6623.34, 6635.65]
            },
            {
              x: new Date(1538784000000),
              y: [6635.65, 6651, 6629.67, 6638.24]
            },
            {
              x: new Date(1538785800000),
              y: [6638.24, 6640, 6620, 6624.47]
            },
            {
              x: new Date(1538787600000),
              y: [6624.53, 6636.03, 6621.68, 6624.31]
            },
            {
              x: new Date(1538789400000),
              y: [6624.61, 6632.2, 6617, 6626.02]
            },
            {
              x: new Date(1538791200000),
              y: [6627, 6627.62, 6584.22, 6603.02]
            },
            {
              x: new Date(1538793000000),
              y: [6605, 6608.03, 6598.95, 6604.01]
            },
            {
              x: new Date(1538794800000),
              y: [6604.5, 6614.4, 6602.26, 6608.02]
            },
            {
              x: new Date(1538796600000),
              y: [6608.02, 6610.68, 6601.99, 6608.91]
            },
            {
              x: new Date(1538798400000),
              y: [6608.91, 6618.99, 6608.01, 6612]
            },
            {
              x: new Date(1538800200000),
              y: [6612, 6615.13, 6605.09, 6612]
            },
            {
              x: new Date(1538802000000),
              y: [6612, 6624.12, 6608.43, 6622.95]
            },
            {
              x: new Date(1538803800000),
              y: [6623.91, 6623.91, 6615, 6615.67]
            },
            {
              x: new Date(1538805600000),
              y: [6618.69, 6618.74, 6610, 6610.4]
            },
            {
              x: new Date(1538807400000),
              y: [6611, 6622.78, 6610.4, 6614.9]
            },
            {
              x: new Date(1538809200000),
              y: [6614.9, 6626.2, 6613.33, 6623.45]
            },
            {
              x: new Date(1538811000000),
              y: [6623.48, 6627, 6618.38, 6620.35]
            },
            {
              x: new Date(1538812800000),
              y: [6619.43, 6620.35, 6610.05, 6615.53]
            },
            {
              x: new Date(1538814600000),
              y: [6615.53, 6617.93, 6610, 6615.19]
            },
            {
              x: new Date(1538816400000),
              y: [6615.19, 6621.6, 6608.2, 6620]
            },
            {
              x: new Date(1538818200000),
              y: [6619.54, 6625.17, 6614.15, 6620]
            },
            {
              x: new Date(1538820000000),
              y: [6620.33, 6634.15, 6617.24, 6624.61]
            },
            {
              x: new Date(1538821800000),
              y: [6625.95, 6626, 6611.66, 6617.58]
            },
            {
              x: new Date(1538823600000),
              y: [6619, 6625.97, 6595.27, 6598.86]
            },
            {
              x: new Date(1538825400000),
              y: [6598.86, 6598.88, 6570, 6587.16]
            },
            {
              x: new Date(1538827200000),
              y: [6588.86, 6600, 6580, 6593.4]
            },
            {
              x: new Date(1538829000000),
              y: [6593.99, 6598.89, 6585, 6587.81]
            },
            {
              x: new Date(1538830800000),
              y: [6587.81, 6592.73, 6567.14, 6578]
            },
            {
              x: new Date(1538832600000),
              y: [6578.35, 6581.72, 6567.39, 6579]
            },
            {
              x: new Date(1538834400000),
              y: [6579.38, 6580.92, 6566.77, 6575.96]
            },
            {
              x: new Date(1538836200000),
              y: [6575.96, 6589, 6571.77, 6588.92]
            },
            {
              x: new Date(1538838000000),
              y: [6588.92, 6594, 6577.55, 6589.22]
            },
            {
              x: new Date(1538839800000),
              y: [6589.3, 6598.89, 6589.1, 6596.08]
            },
            {
              x: new Date(1538841600000),
              y: [6597.5, 6600, 6588.39, 6596.25]
            },
            {
              x: new Date(1538843400000),
              y: [6598.03, 6600, 6588.73, 6595.97]
            },
            {
              x: new Date(1538845200000),
              y: [6595.97, 6602.01, 6588.17, 6602]
            },
            {
              x: new Date(1538847000000),
              y: [6602, 6607, 6596.51, 6599.95]
            },
            {
              x: new Date(1538848800000),
              y: [6600.63, 6601.21, 6590.39, 6591.02]
            },
            {
              x: new Date(1538850600000),
              y: [6591.02, 6603.08, 6591, 6591]
            },
            {
              x: new Date(1538852400000),
              y: [6591, 6601.32, 6585, 6592]
            },
            {
              x: new Date(1538854200000),
              y: [6593.13, 6596.01, 6590, 6593.34]
            },
            {
              x: new Date(1538856000000),
              y: [6593.34, 6604.76, 6582.63, 6593.86]
            },
            {
              x: new Date(1538857800000),
              y: [6593.86, 6604.28, 6586.57, 6600.01]
            },
            {
              x: new Date(1538859600000),
              y: [6601.81, 6603.21, 6592.78, 6596.25]
            },
            {
              x: new Date(1538861400000),
              y: [6596.25, 6604.2, 6590, 6602.99]
            },
            {
              x: new Date(1538863200000),
              y: [6602.99, 6606, 6584.99, 6587.81]
            },
            {
              x: new Date(1538865000000),
              y: [6587.81, 6595, 6583.27, 6591.96]
            },
            {
              x: new Date(1538866800000),
              y: [6591.97, 6596.07, 6585, 6588.39]
            },
            {
              x: new Date(1538868600000),
              y: [6587.6, 6598.21, 6587.6, 6594.27]
            },
            {
              x: new Date(1538870400000),
              y: [6596.44, 6601, 6590, 6596.55]
            },
            {
              x: new Date(1538872200000),
              y: [6598.91, 6605, 6596.61, 6600.02]
            },
            {
              x: new Date(1538874000000),
              y: [6600.55, 6605, 6589.14, 6593.01]
            },
            {
              x: new Date(1538875800000),
              y: [6593.15, 6605, 6592, 6603.06]
            },
            {
              x: new Date(1538877600000),
              y: [6603.07, 6604.5, 6599.09, 6603.89]
            },
            {
              x: new Date(1538879400000),
              y: [6604.44, 6604.44, 6600, 6603.5]
            },
            {
              x: new Date(1538881200000),
              y: [6603.5, 6603.99, 6597.5, 6603.86]
            },
            {
              x: new Date(1538883000000),
              y: [6603.85, 6605, 6600, 6604.07]
            },
            {
              x: new Date(1538884800000),
              y: [6604.98, 6606, 6604.07, 6606]
            },
          ]
        }],
        colors: ['#f9b707','#27b345'],
          chart: {
          type: 'candlestick',
          height: 350,
          toolbar:{
            show: false,
          },
          zoom: {
        enabled: false
      }
        },
        title: {
          text: 'sales Chart',
          align: 'right'
        },
        xaxis: {
          type: 'datetime'
        },
        yaxis: {
          tooltip: {
            enabled: true
          }
        },
        legend: {
          position: 'top',
          horizontalAlign: 'right',
          offsetX: -33,
          colors:'#ffffff'
        },
        };

        var chart = new ApexCharts(document.querySelector("#chart-04"), options);
        chart.render();
      }
  if(jQuery("#chart-05").length){
    var options = {
      series: [{
        name: 'Sales',
        data: [5, 5, 10, 8, 7, 5, 4, null, null, null, 10, 10]
      }, {
        name: 'Order',
        data: [10, 15, null, 12, null, 10, 12, 15, null, null, 12, null]
      }, {
        name: 'Exchange',
        data: [null, null, null, null, 3, 4, 1, 3, 4,  6,  7,  9]
    }],
    colors: ['#f9b707','#27b345','#21d8de'],
      chart: {
      height: 350,
      type: 'line',
      zoom: {
        enabled: false
      },
      toolbar:{
        show: false,
      },
      animations: {
        enabled: false
      }
    },
    stroke: {
      width: [5,5,4],
      curve: 'straight'
    },
    labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16],
   
    xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','July','Aug','Sep','Oct','Nov','Dec'],        

    },
    legend: {
      position: 'top',
      horizontalAlign: 'right',
      offsetX: -33,
      colors:'#000'
    },
    };

    var chart = new ApexCharts(document.querySelector("#chart-05"), options);
    chart.render();
  }
  if(jQuery("#chart-06").length){
    
    var options = {
      series: [{
        name: "Sales",
        data: [45, 52, 38, 24, 33, 26, 21, 20, 6, 8, 15, 10]
      },
      {
        name: "Order",
        data: [35, 41, 62, 42, 13, 18, 29, 37, 36, 51, 32, 35]
      },
      {
        name: 'Echange',
        data: [87, 57, 74, 99, 75, 38, 62, 47, 82, 56, 45, 47]
      }
    ],
    colors: ['#f9b707','#27b345','#21d8de'],
      chart: {
      height: 350,
      type: 'line',
      zoom: {
        enabled: false
      },
      toolbar:{
        show: false,
      },
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      width: [5, 7, 5],
      curve: 'straight',
      dashArray: [0, 8, 5]
    },
   
    legend: {
      position: 'top',
      horizontalAlign: 'right',
      offsetX: -33,
      colors:'#000',
      tooltipHoverFormatter: function(val, opts) {
        return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
      }
    },
    markers: {
      size: 0,
      hover: {
        sizeOffset: 6
      }
    },
    xaxis: {
      categories: ['01 Jan', '02 Jan', '03 Jan', '04 Jan', '05 Jan', '06 Jan', '07 Jan', '08 Jan', '09 Jan',
        '10 Jan', '11 Jan', '12 Jan'
      ],
    },
    tooltip: {
      y: [
        {
          title: {
            formatter: function (val) {
              return val + " (mins)"
            }
          }
        },
        {
          title: {
            formatter: function (val) {
              return val + " per session"
            }
          }
        },
        {
          title: {
            formatter: function (val) {
              return val;
            }
          }
        }
      ]
    },
    grid: {
      borderColor: '#f1f1f1',
    }
    };

    var chart = new ApexCharts(document.querySelector("#chart-06"), options);
    chart.render();
  
  }
  if(jQuery("#chart-07").length){
    var options = {
      series: [{
      name: 'Sales',
      data: [4, 3, 10, 9, 29, 19, 22, 9, 12, 7, 19, 5, 13, 9, 17, 2, 7, 5]
    }],
    colors: ['#f9b707'],
      chart: {
      height: 350,
      type: 'line',
      zoom: {
        enabled: false
      },
      toolbar:{
        show: false,
      },
    },
    forecastDataPoints: {
      count: 7
    },
    stroke: {
      width: 5,
      curve: 'smooth'
    },
    xaxis: {
      type: 'datetime',
      categories: ['1/11/2000', '2/11/2000', '3/11/2000', '4/11/2000', '5/11/2000', '6/11/2000', '7/11/2000', '8/11/2000', '9/11/2000', '10/11/2000', '11/11/2000', '12/11/2000', '1/11/2001', '2/11/2001', '3/11/2001','4/11/2001' ,'5/11/2001' ,'6/11/2001'],
      tickAmount: 10,
      labels: {
        formatter: function(value, timestamp, opts) {
          return opts.dateFormatter(new Date(timestamp), 'dd MMM')
        }
      }
    },
    title: {
      text: 'Exchange',
      align: 'left',
      style: {
        fontSize: "16px",
        color: '#666'
      }
    },
    legend: {
      position: 'top',
      horizontalAlign: 'right',
      offsetX: -33,
      colors:'#000'
    },
    yaxis: {
      min: -10,
      max: 40
    }
    };

    var chart = new ApexCharts(document.querySelector("#chart-07"), options);
    chart.render();
  }
  /*------------------------
  Header
  --------------------------*/
  $(window).on('scroll', function() {
      if ($(this).scrollTop() > 20) {
          $('header').addClass('menu-sticky');
      } else {
          $('header').removeClass('menu-sticky');
      }
  });
  var touch = $('#resp-menu');
  var menu = $('.menu');

  $(touch).on('click', function(e) {
      e.preventDefault();
      menu.slideToggle();
  });

  $(window).resize(function() {
      var w = $(window).width();
      if (w > 767 && menu.is(':hidden')) {
          menu.removeAttr('style');
      }
  });

  /*------------------------
  Jarallax
  --------------------------*/
  if(jQuery(".jarallax").length){
    $('.jarallax').jarallax({
        speed: 0.2
    });
  }

  /*------------------------
  Searchstyle Bar
  --------------------------*/
  if(jQuery(".iq-search").length){
    $(".iq-search").on('click', function() {
        var checkId = document.getElementsByClassName("search-open");
        if (checkId.length > 0) {
            $('.iq-search').removeClass("search-open");
        } else {
            $('.iq-search').addClass("search-open");
        }
    })
  }

  /*------------------------
  Progress Bar
  --------------------------*/
  if(jQuery(".iq-progress-bar").length){
    $('.iq-progress-bar > span').each(function() {
        var $this = $(this);
        var width = $(this).data('percent');
        $this.css({
            'transition': 'width 2s'
        });
        setTimeout(function() {
            $this.appear(function() {
                $this.css('width', width + '%');
            });
        }, 500);
    });
  }

  /*------------------------
  Magnific Popup
  --------------------------*/
  if(jQuery(".popup-gallery").length){
    $('.popup-gallery').magnificPopup({
        delegate: 'a.popup-img',
        tLoading: 'Loading image #%curr%...',
        type: 'image',
        mainClass: 'mfp-img-mobile',
        gallery: {
            navigateByImgClick: true,
            enabled: true,
            preload: [0, 1]
        },
        image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
        }
    });
  }

  if(jQuery(".popup-youtube, .popup-vimeo, .popup-gmaps ").length){
    $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
        type: 'iframe',
        disableOn: 700,
        mainClass: 'mfp-fade',
        preloader: false,
        removalDelay: 160,
        fixedContentPos: false
    });
  }

  /*------------------------
  Countdown
  --------------------------*/
  if(jQuery("#countdown").length){
    $('#countdown').countdown({
        date: '10/03/2022 23:59:59',
        day: 'Day',
        days: 'Days'
    });
  }

  /*------------------------
  widget
  --------------------------*/
  if(jQuery(".iq-widget-menu").length){
    $('.iq-widget-menu > ul > li > a').on('click', function() {
        var checkElement = $(this).next();
        $('.iq-widget-menu li').removeClass('active');
        $(this).closest('li').addClass('active');
        if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
            $(this).closest('li').removeClass('active');
            checkElement.slideUp('normal');
        }
        if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
            $('.iq-widget-menu ul ul:visible').slideUp('normal');
            checkElement.slideDown('normal');
        }
        if ($(this).closest('li').find('ul').children().length === 0) {
            return true;
        } else {
            return false;
        }
    });
  }

  /*------------------------
  counter
  --------------------------*/
  if(jQuery(".timer").length){
    $('.timer').countTo();
  }

  /*------------------------
  Wow Animation
  --------------------------*/
  new WOW().init();

  /*------------------------
  Owl Carousel
  --------------------------*/
  if(jQuery(".owl-carousel").length){
    $('.owl-carousel').each(function() {
        var $carousel = $(this);
        $carousel.owlCarousel({
            items: $carousel.data("items"),
            loop: $carousel.data("loop"),
            margin: $carousel.data("margin"),
            nav: $carousel.data("nav"),
            dots: $carousel.data("dots"),
            autoplay: $carousel.data("autoplay"),
            autoplayTimeout: $carousel.data("autoplay-timeout"),
            navText: ['<i class="fa fa-angle-left fa-2x"></i>', '<i class="fa fa-angle-right fa-2x"></i>'],
            responsiveClass: true,
            responsive: {
                // breakpoint from 0 up
                0: {
                    items: $carousel.data("items-mobile-sm")
                },
                // breakpoint from 480 up
                480: {
                    items: $carousel.data("items-mobile")
                },
                // breakpoint from 786 up
                786: {
                    items: $carousel.data("items-tab")
                },
                // breakpoint from 1023 up
                1023: {
                    items: $carousel.data("items-laptop")
                },
                1199: {
                    items: $carousel.data("items")
                }
            }
        });
    });
  }

  /*------------------------
  Contact from
  --------------------------*/
  if(jQuery("#contact").length){
    $('#contact').submit(function(e) {
        var flag = 0;
        e.preventDefault(); // Prevent Default Submission
        $('.require').each(function() {
            if ($.trim($(this).val()) == '') {
                $(this).css("border", "1px solid red");
                e.preventDefault(); // Prevent Default Submission
                flag = 1;
            } else {
                $(this).css("border", "1px solid grey");
                flag = 0;
            }
        });

        if (grecaptcha.getResponse() == "") {
            flag = 1;
            alert('Please verify Recaptch');

        } else {
            flag = 0;
        }

        if (flag == 0) {
            $.ajax({
                    url: 'contact-form.php',
                    type: 'POST',
                    data: $("#contact").serialize() // it will serialize the form data
                })
                .done(function(data) {
                    $("#result").html('Form was successfully submitted.');
                    $('#contact')[0].reset();
                })
                .fail(function() {
                    alert('Ajax Submit Failed ...');
                });
        }

    });
  }
});