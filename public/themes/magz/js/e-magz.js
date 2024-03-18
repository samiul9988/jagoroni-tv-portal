$(function() {
    'use strict';

    var loading = {
        show: function() {
            $("body").append("<div class='main-loading'></div>");
        },
        hide: function() {
            $(".main-loading").remove();
        }
    }

    var backdrop = {
        show: function(el) {
            if (!el) el = 'body';
            $(el).prepend($("<div/>", {
                class: "backdrop"
            }));
            $(".backdrop").fadeIn();
        },
        hide: function() {
            $(".backdrop").fadeOut(function() {
                $(".backdrop").remove();
            });
        },
        click: function(clicked) {
            $(document).on("click", ".backdrop", function() {
                clicked.call(this);
                return false;
            });
        }
    }

    var stickyHeader = function() {
        var didScroll;
        $(window).on("scroll", function(event) {
            didScroll = true;
        });

        setInterval(function() {
            if (didScroll) {
                hasScrolled();
                didScroll = false;
            }
        }, 250);

        var hasScrolled = function() {
            var scrollTop = $('html').scrollTop();
            var toTop = 0;
            $("header.primary > :not(.menu)").each(function() {
                toTop += $(this).outerHeight();
            });

            if (scrollTop > 100) {
                $("header.primary").addClass("up").css({
                    top: -toTop
                });
            }
            if (scrollTop < 300) {
                $("header.primary").removeClass("up").css({
                    top: 0
                });
            }
        }
    }

    // love
    var love = function() {
        $(".love").each(function() {
            $(this).find("div").html($.number($(this).find("div").html()));
            $(this).on("click", function() {

                var countNow = $(this).find("div").html().replace(',', '');
                if (!$(this).hasClass("active")) {
                    $(this).find(".animated").remove();
                    $(this).addClass("active");
                    $(this).find("i").removeClass("ion-android-favorite-outline");
                    $(this).find("i").addClass("ion-android-favorite");
                    $(this).find("div").html(parseInt(countNow) + 1);
                    $(this).find("div").html($.number($(this).find("div").html()));
                    $(this).append($(this).find("i").clone().addClass("animated"));
                    $(this).find("i.animated").on("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function(e) {
                        $(this).remove();
                        $(this).off(e);
                    });
                    // add some code ("love")
                    var idLike = $(this).data("id");
                    var classActive = $(this).hasClass("active");
                    $.ajax({
                        url: '/post/react',
                        method: 'PATCH',
                        data: { "id": idLike, "val": classActive },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            // console.log("success love");
                        }
                    });
                } else {
                    $(this).find(".animated").remove();
                    $(this).removeClass("active");
                    $(this).find("i").addClass("ion-android-favorite-outline");
                    $(this).find("i").removeClass("ion-android-favorite");
                    $(this).find("div").html(parseInt(countNow) - 1);
                    $(this).find("div").html($.number($(this).find("div").html()));

                    var idLike = $(this).data("id");
                    var classActive = $(this).hasClass("active");
                    $.ajax({
                        url: '/post/react',
                        method: 'PATCH',
                        data: { "id": idLike, "val": classActive },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            // console.log("success love");
                        }
                    });
                }
                return false;
            });
        });
    }

    // newsletter
    var newsletter = function() {
        $(".newsletter").submit(function() {
            var $this = $(this),
            newsletter = {
                start: function() {
                    $this.find(".icon").addClass("spin");
                    $this.find(".icon i").removeClass("ion-ios-email-outline");
                    $this.find(".icon i").addClass("ion-load-b");
                    $this.find(".icon h1").html("Please wait ...");
                    $this.find(".btn").attr("disabled", true);
                    $this.find(".email").attr("disabled", true);
                },
                end: function(message) {
                    $this.find(".icon").removeClass("spin");
                    $this.find(".icon").addClass("success");
                    $this.find(".icon i").addClass("ion-checkmark");
                    $this.find(".icon i").removeClass("ion-load-b");
                    $this.find(".icon h1").html("Thank you!");
                    $this.find(".email").val("");
                    $this.find(".btn").attr("disabled", false);
                    $this.find(".email").attr("disabled", false);
                    $.toast({
                        // text: "Thanks for subscribing!",
                        text: message,
                        position: 'bottom-right',
                        bgcolor: '#E01A31',
                        icon: 'success',
                        heading: 'Newsletter',
                        loader: false
                    });
                },
                error: function() {
                    $this.find(".icon").removeClass("spin");
                    $this.find(".icon").addClass("error");
                    $this.find(".icon i").addClass("ion-ios-close-outline");
                    $this.find(".icon i").removeClass("ion-load-b");
                    $this.find(".icon h1").html("Failed, try again!");
                    $this.find(".btn").attr("disabled", false);
                    $this.find(".email").attr("disabled", false);
                    $.toast({
                        text: "Failed, network error. Please try again!",
                        position: 'bottom-right',
                        icon: 'error',
                        heading: 'Newsletter',
                        loader: false
                    });
                }
            }

            if ($this.find(".email").val().trim().length < 1) {
                $this.find(".email").focus();
            } else {
                $.ajax({
                    url: "/subscribe",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $this.serialize(),
                    error: function(response) {
                        newsletter.error(response.error);
                    },
                    beforeSend: function() {
                        newsletter.start();
                    },
                    success: function(response) {
                        newsletter.end(response.success);
                    }
                });
                newsletter.start();
            }
            return false;
        });
    }

    // floating label
    var floatingLabel = function() {
        $(".floating.focus").each(function() {
            $(this).find(".form-control").focus(function() {
                $(this).parent().addClass("focused");
            }).on("blur", function() {
                if ($(this).val().trim().length < 1) {
                    $(this).parent().removeClass("focused");
                }
            });
        });
    }

    var bestOfTheWeek = function() {
        let dir = document.getElementsByTagName("html")[0].getAttribute("dir");
        let rtl = (dir === 'rtl') ? true : false;
        let autoplay = $('.carousel-1').data('autoplay');

        var botwCarousel = $(".carousel-1").owlCarousel({
            rtl: rtl,
            items: 4,
            autoplay: autoplay,
            autoplayTimeout: 3000,
            loop: true,
            itemElement: 'article',
            margin: 20,
            nav: false,
            dots: false,
            responsive: {
                1024: {
                    items: 4
                },
                768: {
                    items: 2
                },
                0: {
                    items: 1
                }
            }
        });

        $("#best-of-the-week-nav .next").on("click", function() {
            botwCarousel.trigger('next.owl.carousel');
        });

        $("#best-of-the-week-nav .prev").on("click", function() {
            botwCarousel.trigger('prev.owl.carousel');
        });
    }

    function convert_time(duration) {
        var a = duration.match(/\d+/g);
        if (duration.indexOf('M') >= 0 && duration.indexOf('H') == -1 && duration.indexOf('S') == -1) {
            a = [0, a[0], 0];
        }
        if (duration.indexOf('H') >= 0 && duration.indexOf('M') == -1) {
            a = [a[0], 0, a[1]];
        }
        if (duration.indexOf('H') >= 0 && duration.indexOf('M') == -1 && duration.indexOf('S') == -1) {
            a = [a[0], 0, 0];
        }
        duration = 0;
        if (a.length == 3) {
            duration = duration + parseInt(a[0]) * 3600;
            duration = duration + parseInt(a[1]) * 60;
            duration = duration + parseInt(a[2]);
        }
        if (a.length == 2) {
            duration = duration + parseInt(a[0]) * 60;
            duration = duration + parseInt(a[1]);
        }
        if (a.length == 1) {
            duration = duration + parseInt(a[0]);
        }
        var h = Math.floor(duration / 3600);
        var m = Math.floor(duration % 3600 / 60);
        var s = Math.floor(duration % 3600 % 60);
        return ((h > 0 ? h + ":" + (m < 10 ? "0" : "") : "") + m + ":" + (s < 10 ? "0" : "") + s);
    }

    var verticalSlider = function() {
        $(".vertical-slider").each(function(ii) {
            var $this = $(this),
                $item = $this.find($this.data("item")),
                $item_height = 0,
                $item_max = $this.data("max"),
                $nav = $($this.data("nav"));

            $this.attr("data-current", 1);

            $item.each(function(i) {
                i++;
                $(this).attr("data-list", i);
                if (i > $item_max) {
                    return;
                }
                $item_height += ($(this).outerHeight() + 15);
            });

            $this.css({
                overflow: 'hidden'
            });
            $item.wrapAll($("<div/>", {
                style: 'height:' + $item_height + 'px;',
                id: 'vs_inner_' + ii
            }))

            function vs_next() {
                var $current = $this.attr("data-current"),
                    $next = $current;

                var $item_move = $this.find("#vs_inner_" + ii + ' ' + $this.data("item") + "[data-list=" + $next + "]");

                $item_move.fadeOut(function() {
                    var $clone = $item_move.clone().fadeIn();
                    $item_move.remove();
                    $this.find("#vs_inner_" + ii).append($clone);
                });

                $next = parseInt($current) + 1;
                if ($next > $item.length) {
                    $next = 1;
                }
                $this.attr('data-current', $next);
            }

            function vs_prev() {
                var $current = $this.attr("data-current"),
                    $next = $current;

                $next = parseInt($current) - 1;
                if ($next < 1) {
                    $next = $item.length;
                }
                $this.attr('data-current', $next);

                var $item_move = $this.find("#vs_inner_" + ii + ' ' + $this.data("item") + "[data-list=" + $next + "]");
                var $clone = $item_move.clone().css('display', 'none');
                $item_move.remove();
                $this.find("#vs_inner_" + ii).prepend($clone.fadeIn());
            }

            $nav.find(".prev").on("click", function() {
                vs_prev();
            });
            $nav.find(".next").on("click", function() {
                vs_next();
            });
            setInterval(function() {
                vs_next();
            }, 10000);
        });
    }

    var headline = function () {
        let dir = document.getElementsByTagName("html")[0].getAttribute("dir");
        let rtl = (dir === 'rtl') ? true : false;
        let autoplay = $('#headline').data('autoplay');

        var headlineCarousel = $("#headline").owlCarousel({
            rtl: rtl,
            items: 1,
            dots: false,
            autoplay: autoplay,
            autoplayTimeout: 3000,
            loop: true,
            nav: false
        });

        $("#headline-nav [data-slide=next]").on("click", function () {
            headlineCarousel.trigger('next.owl.carousel');
        });

        $("#headline-nav [data-slide=prev]").on("click", function () {
            headlineCarousel.trigger('prev.owl.carousel');
        });
    }

    var featured = function() {
        let dir = document.getElementsByTagName("html")[0].getAttribute("dir");
        let rtl = (dir === 'rtl') ? true : false;
        let autoplay = $('#featured').data('autoplay');

        $("#featured").owlCarousel({
            rtl: rtl,
            items: 1,
            dots: false,
            autoplay: autoplay,
            loop: true
        });
    }

    var toggleMobile = function() {
        $(document).on("click", "[data-toggle=menu]", function() {
            var $this = $(this),
                $target = $($this.data("target"));

            backdrop.click(function() {
                $(".nav-list").removeClass("active");
                $(".nav-list .dropdown-menu").removeClass("active");
                $(".nav-title a").text("Menu");
                $(".nav-title .back").remove();
                $("body").css({
                    overflow: "auto"
                });
                backdrop.hide();
            });

            $("body").css({
                overflow: "hidden"
            });
            backdrop.show('#menu-list');
            setTimeout(function() {
                $target.find('.nav-list').addClass("active");
            }, 50);
            return false;
        });

        $(document).on("click", ".nav-list li.magz-dropdown > a", function() {
            var $this = $(this),
                $parent = $this.parent(),
                $titleBefore = $this.text(),
                $back = '<div class="back"><i class="ion-ios-arrow-left"></i></div>';

            if ($(".nav-title .back").length) {
                var titleNow = $(".nav-title .back").attr('data-title');
                titleNow += ("," + $this.text());
                $(".nav-title .back").attr('data-title', titleNow);
            } else {
                $(".nav-title").prepend($($back).attr('data-title', $(".nav-title a").text() + "," + $this.text()));
            }
            $(".nav-title a").html($this.text());
            $parent.find("> .dropdown-menu").fadeIn(100).addClass("active");
            return false;
        });

        var titleLen = 0;
        $(document).on("click", ".nav-title .back", function() {
            var $dd = $(".dropdown-menu.active"),
                $len = $dd.length,
                title;

            $dd.eq($len - 1).removeClass("active");
            setTimeout(function() {
                $dd.eq($len - 1).hide();
            }, 500);
            title = $(this).attr('data-title').split(",");
            titleLen = title.length - 1;
            title = title.splice(0, titleLen);
            $(".nav-title a").text(title[title.length - 1]);
            $(".nav-title .back").attr('data-title', title);
            if ((title.length - 1) == 0) {
                $(".nav-title .back").remove();
            }
            return false;
        });

        if (!$("#sidebar").length) {
            $("[data-toggle=sidebar]").hide();
        }
        $(document).on("click", "[data-toggle=sidebar]", function() {
            var $this = $(this),
                $target = $($this.data("target"));

            backdrop.click(function() {
                backdrop.hide();
                $target.removeClass("active");
                $("body").css({
                    overflow: "auto"
                });
            });

            $("body").css({
                overflow: "hidden"
            });
            backdrop.show();
            setTimeout(function() {
                $target.addClass("active");
            }, 50);
            return false;
        });
    }

    var showPassword = function() {
        $("input[type='password']").each(function(i) {
            var $this = $(this);

            $this.wrap($("<div/>", {
                style: 'position:relative'
            }));
            $this.css({
                paddingRight: 60
            });
            $this.after($("<div/>", {
                html: 'Show',
                class: 'btn btn-primary btn-sm',
                id: 'passeye-toggle-' + i,
                style: 'position:absolute;right:10px;top:50%;transform:translate(0,-50%);-webkit-transform:translate(0,-50%);-o-transform:translate(0,-50%);padding: 2px 7px;font-size:12px;cursor:pointer;'
            }));
            $this.after($("<input/>", {
                type: 'hidden',
                id: 'passeye-' + i
            }));
            $this.on("keyup paste", function() {
                $("#passeye-" + i).val($(this).val());
            });
            $("#passeye-toggle-" + i).on("click", function() {
                if ($this.hasClass("show")) {
                    $this.attr('type', 'password');
                    $this.removeClass("show");
                    $(this).removeClass("btn-magz");
                    $(this).addClass("btn-primary");
                } else {
                    $this.attr('type', 'text');
                    $this.val($("#passeye-" + i).val());
                    $this.addClass("show");
                    $(this).removeClass("btn-primary");
                    $(this).addClass("btn-magz");
                }
            });
        });
    }

    // alert delete
    function sweetalert2(id, url) {
        Swal.fire({
            width: "25rem",
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    method: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#countComment').html(response.count);
                            $('.commentId'+id).parent().remove();
                            Swal.fire({
                                width: "22rem",
                                title: "Deleted!",
                                text: response.success,
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            })
                        } else {
                            // toastr.error(response.authorize)
                        }
                    },
                    error: function(response) {
                        // toastr.error(response.responseJSON.message)
                    }
                });
            }
        })
    }

    $(document).on("click", "#comment-submit", sendComment);

    function sendComment() {
        var loading = $(this).data('loading-text');
        $("#comment-submit").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">loading</span></div> "+loading);

        var $this = $('#commentForm');
        var url = $('.comment-form').attr('action');
        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: $this.serialize(),
            dataType: 'json',
            success: function(resp) { 
                let errors = resp.errors,
                success = resp.success,
                failed = resp.failed;

                if (errors) {
                    if (errors.name) {
                        $('#name').addClass('is-invalid');
                    }else {
                        $('#name').removeClass('is-invalid');
                    }

                    if (errors.email) {
                        $('#email').addClass('is-invalid');
                    }else {
                        $('#email').removeClass('is-invalid');
                    }

                    if (errors.url) {
                        $('#url').addClass('is-invalid');
                    }else {
                        $('#url').removeClass('is-invalid');
                    }

                    if (errors.comment_exists) {
                        Swal.fire(
                            "",
                            errors.comment_exists,
                            'error'
                        )

                        $this[0].reset();
                        $('#replyId').val('');

                        $('#commentModal').modal('hide');
                    }

                    if (errors.comment) {
                        $('#comment').addClass('is-invalid');
                    }else {
                        $('#comment').removeClass('is-invalid');
                    }
                } else if (success) {

                    var action = $('#commentForm').attr('data-action');

                    if (action == 'edit') {
                        $('.comment-form').attr('data-action', '');
                        $('.commentId' + success.data.id + ' .description').first().html(success.data.comment);
                    } else {
                        $('#countComment').html(success.data.count);

                        if(success.data.reply_id == 0){
                            $('.comment-list').append(commentList(success));
                        }else{
                            $('.commentId' + success.data.reply_id).append(commentReplyList(success));
                        }

                        var newComment = $(".item").children(".commentId"+success.data.id);
                        var offset = newComment.offset().top - ($(window).height() / 2);
                        $('html, body').animate({
                            scrollTop: offset
                        }, 1000);
                    }

                    $this[0].reset();
                    $('#replyId').val('');

                    $('#commentModal').modal('hide');
                } else {

                } 
            }
        });
    }

    $(document).on("click", ".reply", setReply);

    function setReply() {
        let replyId = $(this).closest('.details').data('id'),
        mainReply = $(this).parents('.item').find('.details').data('id');
        
        $('#replyId').val(replyId);
        $('#mainReply').val(mainReply);
        $('#commentModal').modal('show');
        $('#comment').val('');
    }

    $(document).on("click", ".edit-reply", setEditReply);

    function setEditReply() {
        var id = $(this).closest('.details').data('id');
        var txt = $(this).closest('.details').children('.description').text();
        $('#replyId').val(id);
        $('#comment').val(txt);
        var url = window.location.origin + '/update/comment/' + id;
        $('.comment-form').attr('action', url);
        $('.comment-form').attr('data-action', 'edit');
        $('#commentForm').append('<input type="hidden" name="_method" value="PUT">');
        $('#commentModal').modal('show');
    }
    
    $(document).on("click", ".delete-reply", deleteComment);

    function deleteComment() {
        var commentId = $(this).closest('.details').data('id');
        var url = window.location.origin + '/comment/' + commentId;
        sweetalert2(commentId, url);
    }
    
    function commentReplyList(value) {
        let userId = $('#commentForm [name=userid]').val();
        let html = `<div class="reply-list">` +
        `<div class="item message-`+value.data.status+`">` +
           `<div class="user commentId`+value.data.id+`">` +                         
                `<figure>` +
                `<img src="`+ value.data.image +`">` +
                `</figure>` +
                `<div class="details" data-id="`+value.data.id+`">` +
                    `<h5 class="name">`+value.data.name+`</h5>` +
                    `<div class="time">`+value.data.date+`</div>` +
                    `<div class="description">`
                    + value.data.comment +
                    `</div>`;
                    if (value.data.status == "pending") {
                        html += `<div class="message-moderation mt-3">`+value.messageModeration+`</div>`
                    }
                    html += `<footer>`;
                    if (value.data.status == "approved" && value.isReply) {
                        html += `<a class="reply">`+value.action.reply+`</a>`;   
                    }
                    if(userId == value.data.user_id) {
                        html += `<a class="edit-reply">`+value.action.edit+`</a>` +
                        `<a class="delete-reply">`+value.action.delete+`</a>`;
                    }
                    html += `</footer>` +
                `</div>` +
            `</div>` +
        `</div>` +
        `</div>`;

        return html;
    }

    function commentList(value) {
        let userId = $('#commentForm [name=userid]').val();
        let html = `<div class="item message-`+value.data.status+`">` +
            `<div class="user commentId`+value.data.id+`">` +                        
                `<figure>` +
                `<img src="`+ value.data.image +`">` +
                `</figure>` +
                `<div class="details" data-id="`+ value.data.id+`">` +
                    `<h5 class="name">`+ value.data.name+`</h5>` +
                    `<div class="time">`+ value.data.date+`</div>` +
                    `<div class="description">`
                    +  value.data.comment +
                    `</div>`;
                    if (value.data.status == "pending") {
                        html += `<div class="message-moderation mt-3">`+value.messageModeration+`</div>`
                    }
                    html += `<footer>`;
                    if (value.data.status == "approved" && value.isReply) {
                        html += `<a class="reply">`+ value.action.reply+`</a>`;
                    }
                    if(userId == value.data.user_id) {
                        html += `<a class="edit-reply">`+value.action.edit+`</a>` +
                        `<a class="delete-reply">`+value.action.delete+`</a>`;
                    }
                    html += `</footer>` +
                `</div>` +
            `</div>` +
        `</div>`;

        return html;
    }

    var comment = function() {
        $(".comment-form").submit(function() {
            var $this = $(this);
            var url = $('.comment-form').attr('action');
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $this.serialize(),
                dataType: 'json',
                success: function(data) {
                    $this[0].reset();
                    $('#replyId').val('');
                    $('#countComment').html(data.data.count);
                    if(data.data.reply_id == 0){
                        $('.comment-list').append(commentList(data.data));
                    }else{
                        $('.commentId'+data.data.reply_id).append(commentReplyList(data.data));
                    }
                }
            });
            return false;
        });
    }

    var sendContactForm = function() {
        $("#contact-form").submit(function() {
            var $this = $(this);
            var active = $('#captchaCheck').val();
            $('.form-control').removeClass('is-invalid');
            $.ajax({
                url: 'sendcontact',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $this.serialize(),
                dataType: 'json',
                beforeSend: function() {
                    loading.show();
                },
                complete: function() {
                    loading.hide();
                },
                success: function(data) {
                    if (data.status == true) {
                        Swal.fire(
                            data.data.title,
                            data.data.body,
                            'success'
                        )
                        $this[0].reset();
                        if(active == '1') {
                            grecaptcha.reset();
                        }
                    } else if (data.status == false) {
                        Swal.fire(
                            data.data.title,
                            data.data.body,
                            'error'
                        )
                        if(active == 1) {
                            grecaptcha.reset();
                        }
                    } else {
                        $.each( data.data.body, function( i, v ){
                            $('#'+i).addClass('is-invalid');
                            $('#msg-error-'+i).html(v)
                        })
                        
                        if(active == 1) {
                            grecaptcha.reset();
                        }
                    }
                }
            });
            return false;
        });
    }

    var loadFile = function() {
        $("[data-load]").each(function() {
            var $this = $(this);

            $.ajax({
                url: $this.attr('data-load'),
                beforeSend: function() {
                    $this.html('Loading data ...');
                },
                error: function(xhr) {
                    $this.html("[ERROR] Status: " + xhr.status + "\nResponse Text:\n " + xhr.responseText);
                },
                success: function(data) {
                    $this.html(data);
                }
            })
        });
    }

    var themeToggle = function() {
        const toggle__icon = document.getElementById('theme-toggle');
        const theme__mode = document.getElementById('theme-mode');
        const body = document.getElementsByTagName('body')[0];
        const sun__class = 'ion-android-sunny';
        const moon__class = 'ion-ios-moon';
        const hidden__attr = "hidden";
        const dark__theme__class = 'dark-theme';
        const dark__logo = document.querySelectorAll('.logo-dark');
        const light__logo = document.querySelectorAll('.logo-light');

        function addEvent(element, evnt, funct){
            if (element.attachEvent)
                return element.attachEvent('on'+evnt, funct);
            else
                return element.addEventListener(evnt, funct, false);
        }

        function setCookie(name, value) {
            var d = new Date();
            d.setTime(d.getTime() + (365*24*60*60*1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = name + "=" + value + ";" + expires + ";path=/";
        }

        addEvent(
            toggle__icon,
            'click',
            function () {
                if (body.classList.contains(dark__theme__class)) {
                    theme__mode.classList.add(sun__class);
                    theme__mode.classList.remove(moon__class);

                    for (let i = 0; i < dark__logo.length; i++) {
                        dark__logo[i].setAttribute(hidden__attr, '');
                    }

                    for (let i = 0; i < light__logo.length; i++) {
                        light__logo[i].removeAttribute(hidden__attr);
                    }

                    body.classList.remove(dark__theme__class);

                    setCookie('theme_mode', 'light');
                } else {
                    theme__mode.classList.add(moon__class);
                    theme__mode.classList.remove(sun__class);
                    light__logo[0].setAttribute(hidden__attr, '');
                    dark__logo[0].removeAttribute(hidden__attr);

                    for (let i = 0; i < light__logo.length; i++) {
                        light__logo[i].setAttribute(hidden__attr, '');
                    }

                    for (let i = 0; i < dark__logo.length; i++) {
                        dark__logo[i].removeAttribute(hidden__attr);
                    }

                    body.classList.add(dark__theme__class);

                    setCookie('theme_mode', 'dark');
                }
            }
        );
    }

    // Run Function
    stickyHeader();
    love();
    newsletter();
    comment();
    floatingLabel();
    bestOfTheWeek();
    verticalSlider();
    headline();
    featured();
    toggleMobile();
    showPassword();
    sendContactForm();
    loadFile();
})
