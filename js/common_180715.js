$(function() {
    page.init();
})

var page = {
    init: function() {
        page.common();
        
        page.about();
        
        page.park();
        
        page.museum();
        
        page.style();
    },
    common: function() {
        //gnb
        var header = $("#header");
        var headerBox = $("#header .header_box");
        var getLogoMobile = $("#header .logo_box");
        $(".gnb_box").hover(
            function() {
                if(!getLogoMobile.is(":visible")) {
                    headerBox.stop(true,true).animate({ height:410 }, 200);
                }
            },
            function() {
                if(!getLogoMobile.is(":visible")) {
                    headerBox.stop(true,true).animate({ height:98 }, 200);
                    $("#gnb .menu.active").removeClass("active");
                }
            }
        );
        $("#gnb .menu").hover(
            function() {
                if(!getLogoMobile.is(":visible")) {
                    $("#gnb .menu.active").removeClass("active");
                    $(this).addClass("active");
                }
            }
        );
        $("#gnb .btn_menu").on("click", function() {
            if(getLogoMobile.is(":visible")) {
                var getMenu = $(this).parent();
                if(getMenu.hasClass("active")) {
                    getMenu.removeClass("active").find(".sub_menu").stop(true,true).slideUp(200);
                }
                else {
                    $("#gnb .menu.active").removeClass("active").find(".sub_menu").stop(true,true).slideUp(200);
                    getMenu.addClass("active").find(".sub_menu").stop(true,true).slideDown(200);
                }
                return false;
            }
        });
        
        var headerMask = $("#header .header_mask");
        var headerGnbBox = $("#header .gnb_box");
        $("#header .btn_close").on("click", function() {
            headerMask.stop(true,true).fadeOut(200);
            headerGnbBox.stop(true,true).animate({ right:"-100%" }, 200, function() {
                $("body").removeClass("popup");
            });
            return false;
        });
        $("#header .btn_sidemenu").on("click", function() {
            $("body").addClass("popup");
            headerMask.stop(true,true).fadeIn(200);
            headerGnbBox.stop(true,true).animate({ right:0, opacity:1 }, 200);
            return false;
        });
        
        //퀵메뉴
        var quickMenu = $("#quick_menu");
        var quickMenuBox = $("#quick_menu .menu_box");
        $("#quick_menu .btn_quick").on("click", function() {
            if(quickMenu.hasClass("active")) {
                quickMenu.removeClass("active");
                quickMenuBox.stop(true,true).slideDown(200);
            }
            else {
                quickMenu.addClass("active");
                quickMenuBox.stop(true,true).slideUp(200);
            }
            return false;
        });
        $("#quick_menu .btn_top").on("click", function() {
            $("html,body").stop(true,true).animate({ scrollTop:0 }, 300);
            return false;
        });
        
        var getQuickTop = quickMenu.addClass("on").offset().top - 30;
        function quickScroll() {
            var getScrollTop = $(window).scrollTop();
            if(getScrollTop > getQuickTop) {
                quickMenu.addClass("fixed");
            }
            else {
                quickMenu.removeClass("fixed");
            }
        }
        
        $(window).on("scroll touchmove", function() {
            quickScroll();
        });
        quickScroll();
    },
    about: function() {
        if($("#panel_tab").length > 0) {
            var btnPanelTab = $("#panel_tab .btn_tab").on("click", function() {
                btnPanelTab.removeClass("active");
                $(".panel_tab_area").removeClass("active").eq($(this).addClass("active").index()).addClass("active");
                return false;
            });
        }
        
        //갤러리
        if($("#bbs_grid_gallery").length > 0) {
            $("#bbs_grid_gallery img").imgpreload(function() {
                $("#bbs_grid_gallery").masonry({
                    itemSelector: ".gallery_box",
                    percentPosition: true
                });
            });
        }
        
        //명예의전당 갤러리
        if($("#honor_gallery_slide").length > 0) {
            var gallerySlide = $("#honor_gallery_slide").lightSlider({
                gallery:true,
                item:1,
                thumbItem:14,
                slideMargin:5,
                thumbMargin:10,
                speed:500,
                auto:false,
                controls:false,
                loop:true,
                adaptiveHeight:true,
                currentPagerPosition:"right",
                responsive: [
                    {
                        breakpoint:1024,
                        settings: {
                            thumbItem:10
                        }
                    },
                    {
                        breakpoint:760,
                        settings: {
                            thumbItem:6,
                            thumbMargin:5
                        }
                    }
                ],
                onSliderLoad: function() {
                    $("#honor_gallery_slide").removeClass("cS-hidden");
                    $(".lSSlideOuter").append("<div class='lsslide_arrow'><a href='#' class='btn_prev'><a href='#' class='btn_next'></div>");
                    $(".lSPager").wrap("<div class='lSPager_wrap'></div>").parent().parent().append("<div class='lspager_arrow'><a href='#' class='btn_prev'><a href='#' class='btn_next'></div>");
                    
                    $(".lSSlideOuter .btn_prev").on("click", function() {
                        gallerySlide.goToPrevSlide();
                        return false;
                    });
                    $(".lSSlideOuter .btn_next").on("click", function() {
                        gallerySlide.goToNextSlide();
                        return false;
                    });
                }  
            });
        }
    },
    park: function() {
        //인터뷰 슬라이드
        if($("#interview_slide").length > 0) {
            $("#interview_slide").slick({
                arrows:false,
                dots:true
            });
        }
        
        //히스토리 탭
        var btnHistoryTab = $("#history_tab_menu .btn_year").on("click", function() {
            btnHistoryTab.removeClass("active");
            var getIdx = $(this).addClass("active").index();
            $(".history_tab_panel").removeClass("active").eq(getIdx).addClass("active");
            return false;
        });
    },
    museum: function() {
        //상세 슬라이드
        if($("#museum_detail_slide").length > 0) {
            $("#museum_detail_slide").elevateZoom({
                zoomWindowPosition: "detail_zoom", zoomWindowHeight: 514, zoomWindowWidth:588, borderSize: 1, easing:true, 
                gallery:"museum_detail_thumb", cursor:"pointer", galleryActiveClass:"active"
            }); 
            
            var getDetailThumb = $("#museum_detail_thumb");
            var getThumb = $("#museum_detail_thumb .btn_thumb");
            getThumb.eq(0).addClass("active");
            if(getThumb.length < 4) {
                for(var i = getThumb.length; i < 4; i++) {
                    getDetailThumb.append("<div class='btn_thumb'></div>");
                }
            }

            $("#museum_detail_slide").magnificPopup({
                removalDelay: 300,
                mainClass: "mfp-fade",
                type: "image", 
                callbacks: {
                    elementParse: function(item) {
                        item.src = $("#museum_detail_slide").attr("src");
                        return item;
                    }
                }
            });
        }
    },
    style: function() {
        //셀렉트 박스
        $(".select_box:not(.on)").each(function() {
            var getSelect = $(this).removeClass("select_box").addClass("select").wrap("<div class='select_box on'></div>");
            var getSelectBox = getSelect.parent();
            var getValue = $('<a href="#" class="btn_value">' + getSelect.find("option:selected").text() + '</a>');
            var getSelectList = $('<div class="select_list"></div>');
            var getList = [];
            getSelect.find("option").each(function() {
                getList.push('<a href="#" data-value="' + $(this).val() + '">' + $(this).text() + '</a>');
            });
            getSelectBox.append(getSelectList.append(getList.join("")));
            getSelectBox.append(getValue);
            getSelectBox.append('<span class="icon"></span>');
            getSelect.on("change", function() {
                getValue.html(getSelect.find("option:selected").text());
                getSelectList.find("a.active").removeClass("active");
                getSelectList.find("a[data-value='" + this.value + "']").addClass("active");
                getSelectBox.removeClass("active");
                getSelectList.stop(true,true).slideUp(200);
                
                if($(this).hasClass("select_lnb_main")) {
                    //서브 카테고리 생성
                }
                else if($(this).hasClass("select_page_move")) {
                    location.href = this.value;
                    //페이지 이동
                }
                else if($(this).hasClass("select_join_email")) {
                    //이메일 선택
                    if(this.value !== "") {
                        if(this.value == "input") {
                            $(this).closest(".email_box").find(".input_text").eq(1).prop("readonly",false).val("").focus();
                        }
                        else {
                            $(this).closest(".email_box").find(".input_text").eq(1).prop("readonly",true).val(this.value);
                        }
                    }
                }
            });
            getSelectList.find("a[data-value='" + getSelect.find("option:selected").val() + "']").addClass("active");
            getValue.on("click", function() {
                if(getSelectBox.hasClass("active")) {
                    getSelectBox.removeClass("active");
                    getSelectList.stop(true,true).slideUp(200);
                }
                else {
                    $(".select_box.active").removeClass("active").find(".select_list").stop(true,true).slideUp(200);
                    getSelectBox.addClass("active");
                    getSelectList.stop(true,true).slideDown(200);
                }
                return false;
            });
            getSelectList.find("a").on("click", function() {
                var getVal = $(this).data("value");
                getSelect.val(getVal).trigger("change");
                return false;
            });
        });
        
        //파일 선택
        $(".file_area:not(.on)").addClass("on").find(".input_file").on("change", function() {
            $(this).closest(".file_area").find(".input_name").html(this.value.split("\\").pop());
        });
        
        //체크, 라디오 박스
        $(".check_box:not(.on)").each(function() {
            $(this).addClass("on").find(".check").on("change", function() {
                if(this.checked) $(this).parent().addClass("active");
                else $(this).parent().removeClass("active");
            }).trigger("change");
        });
        
        $(".radio_box:not(.on)").each(function() {
            $(this).addClass("on").find(".radio").on("change", function() {
                if(this.checked) {
                    $(this).closest(".radio_area").find(".active").removeClass("active");
                    $(this).parent().addClass("active");
                }
            }).trigger("change");
        });
    }
}
