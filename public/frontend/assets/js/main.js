/**

  * selectImages
  * btnQuantity
  * delete_file
  * goTop
  * closeAnnouncement
  * sidebar_mb
  * tabs
  * swatchColor
  * changeValue
  * footer
  * btn_wishlist
  * btn_loading
  * loadItem
  * stagger_wrap
  * clickModalSecond
  * scrollProgress
  * headerSticky
  * img_group
  * filterTab
  * autoPopup
  * rangePrice
  * clickControl
  * checkClick
  * write_review
  * customInput
  * chooseOption
  * withDiscount
  * totalPriceVariant
  * variantPicker
  * scrollGridProduct
  * hoverPin
  * togglePassword
  * customDropdown
  * ajaxContactForm
  * loadmore
  * hasPurchased
  * checkPaymentCard
  * handleFooter
  * handleProgress
  * heightModalmenu
  * ajaxSubscribe.eventLoad
  * preloader

 */

(function ($) {
  "use strict";

  /* selectImages
  -------------------------------------------------------------------------------------*/
  var selectImages = function () {
    if ($(".image-select").length > 0) {
      const selectIMG = $(".image-select");

      selectIMG.find("option").each((idx, elem) => {
        const selectOption = $(elem);
        const imgURL = selectOption.attr("data-thumbnail");
        if (imgURL) {
          selectOption.attr(
            "data-content",
            `<img src="${imgURL}" /> ${selectOption.text()}`
          );
        }
      });
      selectIMG.selectpicker();
    }
  };



  /* Button Quantity
  -------------------------------------------------------------------------------------*/
  var btnQuantity = function () {
    $(".minus-btn").on("click", function (e) {
      e.preventDefault();
      var $this = $(this);
      var $input = $this.closest("div").find("input");
      var value = parseInt($input.val());

      if (value > 1) {
        value = value - 1;
      }
      $input.val(value);
    });

    $(".plus-btn").on("click", function (e) {
      e.preventDefault();
      var $this = $(this);
      var $input = $this.closest("div").find("input");
      var value = parseInt($input.val());

      if (value > -1) {
        value = value + 1;
      }
      $input.val(value);
    });
  };

  /* Delete file 
  -------------------------------------------------------------------------------------*/
  var delete_file = function (e) {
    $(".remove").on("click", function (e) {
      e.preventDefault();
      var $this = $(this);
      $this.closest(".file-delete").remove();
    });
    $(".clear-file-delete").on("click", function (e) {
      e.preventDefault();
      $(this).closest(".list-file-delete").find(".file-delete").remove();
    });
  };

  /* Go Top
  -------------------------------------------------------------------------------------*/
  var goTop = function () {
    let scrollTopButton = $("#scroll-top");
    let isButtonVisible = false;

    function checkScroll() {
      let scrollTop = $(window).scrollTop();

      if (scrollTop > 500 && !isButtonVisible) {
        scrollTopButton.addClass("show");
        isButtonVisible = true;
      } else if (scrollTop <= 500 && isButtonVisible) {
        scrollTopButton.removeClass("show");
        isButtonVisible = false;
      }
    }

    function onScroll() {
      requestAnimationFrame(checkScroll);
    }

    $(window).on("scroll", onScroll);

    scrollTopButton.on("click", function (e) {
      e.preventDefault();
      $("html, body").scrollTop(0);
    });
  };

  /* variant picker
  -------------------------------------------------------------------------*/
  var variantPicker = function () {
    if ($(".variant-picker-item").length) {
      $(".variant-picker-item label").on("click", function (e) {
        $(this)
          .closest(".variant-picker-item")
          .find(".variant-picker-label-value")
          .text($(this).data("value"));
      });
    }
    if ($(".variant-picker-item").length) {
      $(".select-size").on("click", function (e) {
        $(this)
          .closest(".variant-picker-item")
          .find(".variant-picker-label-value")
          .text($(this).data("value"));
      });
    }
  };

  /* color swatch product
  -------------------------------------------------------------------------*/
  var swatchColor = function () {
    if ($(".card-product").length > 0) {
      $(".color-swatch").on("click, mouseover", function () {
        var swatchColor = $(this).find("img").attr("src");
        var imgProduct = $(this).closest(".card-product").find(".img-product");
        imgProduct.attr("src", swatchColor);
        $(this)
          .closest(".card-product")
          .find(".color-swatch.active")
          .removeClass("active");

        $(this).addClass("active");
      });
    }
  };

  /* change value
  ------------------------------------------------------------------------------------- */
  var changeValue = function () {
    if ($(".tf-dropdown-sort").length > 0) {
      $(".select-item").click(function (event) {
        $(this)
          .closest(".tf-dropdown-sort")
          .find(".text-sort-value")
          .text($(this).find(".text-value-item").text());

        $(this)
          .closest(".dropdown-menu")
          .find(".select-item.active")
          .removeClass("active");

        $(this).addClass("active");

        var color = $(this).data("value-color");
        $(this)
          .closest(".tf-dropdown-sort")
          .find(".btn-select")
          .find(".current-color")
          .css("background", color);
      });
    }
  };

  /* close announcement bar
  -------------------------------------------------------------------------*/
  var closeAnnouncement = function () {
    $(".close-announcement-bar").on("click", function (e) {
      e.preventDefault();
      var $this = $(this);
      var $height = $(".announcement-bar").height() + "px";
      $this.closest(".announcement-bar").css("margin-top", `-${$height}`);

      $(".announcement-bar").fadeOut("slow", function () {
        $this.closest(".announcement-bar").remove();
      });
    });
  };

  /* range
  -------------------------------------------------------------------------*/
  var rangePrice = function () {
    $(".widget-size").each(function () {
      var $rangeInput = $(this).find(".range-input input");
      var $progress = $(this).find(".progress-size");
      var $maxPrice = $(this).find(".max-size");

      $rangeInput.on("input", function () {
        var maxValue = parseInt($rangeInput.val(), 10);

        var percentMax = (maxValue / $rangeInput.attr("max")) * 100;
        $progress.css("width", percentMax + "%");

        $maxPrice.html(maxValue);
      });
    });
  };

  /* sidebar mobile
  -------------------------------------------------------------------------*/
  var sidebar_mb = function () {
    if ($(".wrap-sidebar-account").length > 0) {
      var sidebar = $(".wrap-sidebar-account").html();
      $(".sidebar-mobile-append").append(sidebar);
    }
  };

  /* tabs
  -------------------------------------------------------------------------*/
  var tabs = function () {
    $(".widget-tabs").each(function () {
      $(this)
        .find(".widget-menu-tab")
        .children(".item-title")
        .on("click", function () {
          var liActive = $(this).index();
          var contentActive = $(this)
            .siblings()
            .removeClass("active")
            .parents(".widget-tabs")
            .find(".widget-content-tab")
            .children()
            .eq(liActive);
          contentActive.addClass("active").fadeIn("slow");
          contentActive.siblings().removeClass("active");
          $(this)
            .addClass("active")
            .parents(".widget-tabs")
            .find(".widget-content-tab")
            .children()
            .eq(liActive);
        });
    });
  };


  /* check active 
  -------------------------------------------------------------------------*/
  var checkClick = function () {
    $(".size-box,.facet-color-box").on(
      "click",
      ".size-item,.color-item",
      function () {
        $(this)
          .closest(".size-box,.facet-color-box")
          .find(".size-item,.color-item")
          .removeClass("active");
        $(this).addClass("active");
      }
    );
  };

  /* checkPaymentCard 
  -------------------------------------------------------------------------*/
  var checkPaymentCard = function () {
    $(".payment-box").on("click", ".payment-choose-card .payment-header", function (event) {
      var paymentItem = $(this).closest(".payment-choose-card");
      $(".payment-box .payment-choose-card").not(paymentItem).removeClass("active");
      paymentItem.toggleClass("active");
    });
    $(".payment-box").on("show.bs.collapse", function (e) {
      $(e.target).closest(".payment-choose-card").addClass("active");
    });

    $(".payment-box").on("hide.bs.collapse", function (e) {
      $(e.target).closest(".payment-choose-card").removeClass("active");
    });
  }

  /* button loading
  -------------------------------------------------------------------------*/
  var btn_loading = function () {
    if ($(".tf-loading").length) {
      $(".tf-loading").on("click", function (e) {
        $(this).addClass("loading");
        var $this = $(this);
        setTimeout(function () {
          $this.removeClass("loading");
        }, 600);
      });
    }
  };

  /* infinite scroll
  -------------------------------------------------------------------------*/
  var loadItem = function () {
    const gridInitialItems = 8;
    const listInitialItems = 4;
    const gridItemsPerPage = 4;
    const listItemsPerPage = 2;

    let listItemsDisplayed = listInitialItems;
    let gridItemsDisplayed = gridInitialItems;
    let scrollTimeout;

    function hideExtraItems(layout, itemsDisplayed) {
      layout.find(".loadItem").each(function (index) {
        if (index >= itemsDisplayed) {
          $(this).addClass("hidden");
        }
      });
      if (layout.is("#listLayout")) updateLastVisible(layout);
    }

    function showMoreItems(layout, itemsPerPage, itemsDisplayed) {
      const hiddenItems = layout.find(".loadItem.hidden");

      setTimeout(function () {
        hiddenItems.slice(0, itemsPerPage).removeClass("hidden");
        if (layout.is("#listLayout")) updateLastVisible(layout);
        checkLoadMoreButton(layout);
      }, 600);

      return itemsDisplayed + itemsPerPage;
    }

    function updateLastVisible(layout) {
      layout.find(".loadItem").removeClass("last-visible");
      layout
        .find(".loadItem")
        .not(".hidden")
        .last()
        .addClass("last-visible");
    }
    function checkLoadMoreButton(layout) {
      if (layout.find(".loadItem.hidden").length === 0) {
        if (layout.is("#listLayout")) {
          $("#loadMoreListBtn").hide();
          $("#infiniteScrollList").hide();
        } else if (layout.is("#gridLayout")) {
          $("#loadMoreGridBtn").hide();
          $("#infiniteScrollGrid").hide();
        }
      }
    }

    hideExtraItems($("#listLayout"), listItemsDisplayed);
    hideExtraItems($("#gridLayout"), gridItemsDisplayed);

    $("#loadMoreListBtn").on("click", function () {
      listItemsDisplayed = showMoreItems(
        $("#listLayout"),
        listItemsPerPage,
        listItemsDisplayed
      );
    });



    $("#loadMoreGridBtn").on("click", function () {
      gridItemsDisplayed = showMoreItems(
        $("#gridLayout"),
        gridItemsPerPage,
        gridItemsDisplayed
      );
    });

    // Infinite Scrolling
    function onScroll() {
      clearTimeout(scrollTimeout);
      scrollTimeout = setTimeout(function () {
        const infiniteScrollList = $("#infiniteScrollList");
        const infiniteScrollGrid = $("#infiniteScrollGrid");

        if (
          infiniteScrollList.is(":visible") &&
          isElementInViewport(infiniteScrollList)
        ) {
          listItemsDisplayed = showMoreItems(
            $("#listLayout"),
            listItemsPerPage,
            listItemsDisplayed
          );
        }

        if (
          infiniteScrollGrid.is(":visible") &&
          isElementInViewport(infiniteScrollGrid)
        ) {
          gridItemsDisplayed = showMoreItems(
            $("#gridLayout"),
            gridItemsPerPage,
            gridItemsDisplayed
          );
        }
      }, 300);
    }
    function isElementInViewport(el) {
      const rect = el[0].getBoundingClientRect();
      return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <=
        (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <=
        (window.innerWidth || document.documentElement.clientWidth)
      );
    }
    $(window).on("scroll", onScroll);
  };

  /* stagger wrap
  -------------------------------------------------------------------------*/
  var stagger_wrap = function () {
    if ($(".stagger-wrap").length) {
      var count = $(".stagger-item").length;
      for (var i = 1, time = 0.2; i <= count; i++) {
        $(".stagger-item:nth-child(" + i + ")")
          .css("transition-delay", time * i + "s")
          .addClass("stagger-finished");
      }
    }
  };



  /* modal second
  -------------------------------------------------------------------------*/
  var clickModalSecond = function () {
    $(".btn-add-to-cart").click(function () {
      $(".tf-add-cart-success").addClass("active");
    });
    $(".tf-add-cart-success .tf-add-cart-close").click(function () {
      $(".tf-add-cart-success").removeClass("active");
    });
    $(".show-size-guide").click(function () {
      $("#size-guide").modal("show");
    });
    $(".show-shopping-cart").click(function () {
      $("#shoppingCart").modal("show");
    });
    $(".btn-icon-action.wishlist").click(function () {
      $("#wishlist").modal("show");
    });

    $(".btn-add-note").click(function () {
      $(".add-note").addClass("open");
    });
    $(".btn-add-coupon").click(function () {
      $(".add-coupon").addClass("open");
    });
    $(".btn-estimate-shipping").click(function () {
      $(".estimate-shipping").addClass("open");
    });
    $(".tf-mini-cart-tool-close").click(function () {
      $(".tf-mini-cart-tool-openable").removeClass("open");
    });
  };

  /* header sticky
  -------------------------------------------------------------------------*/
  var headerSticky = function () {
    let lastScrollTop = 0;
    let delta = 5;
    let navbarHeight = $("header").outerHeight();
    let didScroll = false;

    $(window).scroll(function () {
      didScroll = true;
    });

    setInterval(function () {
      if (didScroll) {
        let st = $(window).scrollTop();
        navbarHeight = $("header").outerHeight();

        if (st > navbarHeight) {
          if (st > lastScrollTop + delta) {
            $("header").css("top", `-${navbarHeight}px`);
          } else if (st < lastScrollTop - delta) {
            $("header").css("top", "0");
            $("header").addClass("header-bg");
          }
        } else {
          $("header").css("top", "unset");
          $("header").removeClass("header-bg");
        }
        lastScrollTop = st;
        didScroll = false;
      }
    }, 250);
  };


  /* contact form
  ------------------------------------------------------------------------------------- */
  var ajaxContactForm = function () {
    $("#contactform").each(function () {
      $(this).validate({
        submitHandler: function (form) {
          var $form = $(form),
            str = $form.serialize(),
            loading = $("<div />", { class: "loading" });

          $.ajax({
            type: "POST",
            url: $form.attr("action"),
            data: str,
            beforeSend: function () {
              $form.find(".send-wrap").append(loading);
            },
            success: function (msg) {
              var result, cls;
              if (msg == "Success") {
                result =
                  "Email Sent Successfully. Thank you, Your application is accepted - we will contact you shortly";
                cls = "msg-success";
              } else {
                result = "Error sending email.";
                cls = "msg-error";
              }
              $form.prepend(
                $("<div />", {
                  class: "flat-alert " + cls,
                  text: result,
                }).append(
                  $(
                    '<a class="close" href="#"><i class="icon icon-close2"></i></a>'
                  )
                )
              );

              $form.find(":input").not(".submit").val("");
            },
            complete: function (xhr, status, error_thrown) {
              $form.find(".loading").remove();
            },
          });
        },
      });
    }); 
  };

  /* subscribe mailchimp
  ------------------------------------------------------------------------------------- */
  var ajaxSubscribe = {
    obj: {
      subscribeEmail: $("#subscribe-email"),
      subscribeButton: $("#subscribe-button"),
      subscribeMsg: $("#subscribe-msg"),
      subscribeContent: $("#subscribe-content"),
      dataMailchimp: $("#subscribe-form").attr("data-mailchimp"),
      success_message:
        '<div class="notification_ok text-success">Thank you for joining our mailing list!</div>',
      failure_message:
        '<div class="notification_error text-critical">Error! <strong>There was a problem processing your submission.</strong></div>',
      noticeError: '<div class="notification_error">{msg}</div>',
      noticeInfo: '<div class="notification_error">{msg}</div>',
      basicAction: "mail/subscribe.php",
      mailChimpAction: "mail/subscribe-mailchimp.php",
    },

    eventLoad: function () {
      var objUse = ajaxSubscribe.obj;

      $(objUse.subscribeButton).on("click", function () {
        if (window.ajaxCalling) return;
        var isMailchimp = objUse.dataMailchimp === "true";

        ajaxSubscribe.ajaxCall(objUse.basicAction);
      });
    },

    ajaxCall: function (action) {
      window.ajaxCalling = true;
      var objUse = ajaxSubscribe.obj;
      var messageDiv = objUse.subscribeMsg.html("").hide();
      $.ajax({
        url: action,
        type: "POST",
        dataType: "json",
        data: {
          subscribeEmail: objUse.subscribeEmail.val(),
        },
        success: function (responseData, textStatus, jqXHR) {
          if (responseData.status) {
            objUse.subscribeContent.fadeOut(500, function () {
              messageDiv.html(objUse.success_message).fadeIn(500);
            });
          } else {
            switch (responseData.msg) {
              case "email-required":
                messageDiv.html(
                  objUse.noticeError.replace(
                    "{msg}",
                    "Error! <strong>Email is required.</strong>"
                  )
                );
                break;
              case "email-err":
                messageDiv.html(
                  objUse.noticeError.replace(
                    "{msg}",
                    "Error! <strong>Email invalid.</strong>"
                  )
                );
                break;
              case "duplicate":
                messageDiv.html(
                  objUse.noticeError.replace(
                    "{msg}",
                    "Error! <strong>Email is duplicate.</strong>"
                  )
                );
                break;
              case "filewrite":
                messageDiv.html(
                  objUse.noticeInfo.replace(
                    "{msg}",
                    "Error! <strong>Mail list file is open.</strong>"
                  )
                );
                break;
              case "undefined":
                messageDiv.html(
                  objUse.noticeInfo.replace(
                    "{msg}",
                    "Error! <strong>undefined error.</strong>"
                  )
                );
                break;
              case "api-error":
                objUse.subscribeContent.fadeOut(500, function () {
                  messageDiv.html(objUse.failure_message);
                });
            }
            messageDiv.fadeIn(500);
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          alert("Connection error");
        },
        complete: function (data) {
          window.ajaxCalling = false;
        },
      });
    },
  };

  /* auto popup
  ------------------------------------------------------------------------------------- */
  var autoPopup = function () {
    if ($(".auto-popup").length > 0) {
      let showPopup = sessionStorage.getItem("showPopup");
      if (!JSON.parse(showPopup)) {
        setTimeout(function () {
          $(".auto-popup").modal("show");
        }, 3000);
      }
    }
    $(".btn-hide-popup").on("click", function () {
      sessionStorage.setItem("showPopup", true);
    });
  };

  /* toggle control
  ------------------------------------------------------------------------------------- */
  var clickControl = function () {
    $(".btn-address").click(function () {
      $(".show-form-address").toggle();
    });
    $(".btn-hide-address").click(function () {
      $(".show-form-address").hide();
    });
    $(".btn-edit-address").click(function () {
      $(this)
        .closest(".account-address-item")
        .find(".edit-form-address")
        .toggle();
    });
    $(".btn-hide-edit-address").click(function () {
      $(this)
        .closest(".account-address-item")
        .find(".edit-form-address")
        .hide();
    });
    $(".btn-delete-address").click(function () {
      $(this).closest(".account-address-item").remove();
    });
  };

  /* write-review
  ------------------------------------------------------------------------------------- */
  

  /* customInput
  ------------------------------------------------------------------------------------- */
  

  /* chooseOption
  ------------------------------------------------------------------------------------- */


  /* withDiscount
  ------------------------------------------------------------------------------------- */
 

  /* totalPriceVariant
  ------------------------------------------------------------------------------------- */
  var totalPriceVariant = function () {
    $(".tf-product-info-list,.tf-cart-item").each(function () {
      var productItem = $(this);
      var basePrice = parseFloat(productItem.find(".price-on-sale").data("base-price")) || parseFloat(productItem.find(".price-on-sale").text().replace("$", ""));
      var quantityInput = productItem.find(".quantity-product");

      productItem.find(".btn-increase").on("click", function () {
        var currentQuantity = parseInt(quantityInput.val());
        quantityInput.val(currentQuantity + 1);
        updateTotalPrice(null, productItem);
      });

      productItem.find(".btn-decrease").on("click", function () {
        var currentQuantity = parseInt(quantityInput.val());
        if (currentQuantity > 1) {
          quantityInput.val(currentQuantity - 1);
          updateTotalPrice(null, productItem);
        }
      });

    });
  };


  /* scroll grid product
  ------------------------------------------------------------------------------------- */
  var scrollGridProduct = function () {
    var headerHeight = $("#header").outerHeight();
    var activescrollBtn = null;
    $(".btn-scroll-target").on("click", function () {
      var scroll = $(this).data("scroll");
      var target = $(".item-scroll-target[data-scroll='" + scroll + "']");
      $("html, body").animate(
        {
          scrollTop: target.offset().top - headerHeight,
        },
        100
      );

      $(".btn-scroll-target").removeClass("active");
      $(this).addClass("active");
      activescrollBtn = $(this);
    });

    $(window).on("scroll", function () {
      var isActiveSet = false;
      $(".item-scroll-target").each(function () {
        var targetTop = $(this).offset().top - headerHeight;
        if (
          $(window).scrollTop() >= targetTop &&
          $(window).scrollTop() < targetTop + $(this).outerHeight()
        ) {
          var scroll = $(this).data("scroll");
          if (
            !isActiveSet &&
            (activescrollBtn === null ||
              activescrollBtn.data("scroll") !== scroll)
          ) {
            $(".btn-scroll-target").removeClass("active");
            $(".btn-scroll-target[data-scroll='" + scroll + "']").addClass(
              "active"
            );
          }
          isActiveSet = true;
        }
      });
      if (!isActiveSet && activescrollBtn !== null) {
        $(".btn-scroll-target").removeClass("active");
        activescrollBtn.addClass("active");
      }
    });
  };

  var scrollQuickView = function () {
  
    var scrollContainer = $(".modal-quick-view .wrapper-scroll-quickview");
    var activescrollBtn = null;
    var offsetTolerance = 100; 
  
    function getTargetScroll(target, isHorizontal) {
      if (isHorizontal) {
        return (
          target.offset().left - scrollContainer.offset().left + scrollContainer.scrollLeft()
        );
      } else {
        return (
          target.offset().top - scrollContainer.offset().top + scrollContainer.scrollTop()
        );
      }
    }
  
    function isHorizontalMode() {
      return window.innerWidth < 767; 
    }
  
    $(".btn-scroll-quickview").on("click", function () {
  
      var scroll = $(this).data("scroll-quickview");
      var target = $(
        `.item-scroll-quickview[data-scroll-quickview='${scroll}']`
      );
  
      if (target.length > 0) {
        var isHorizontal = isHorizontalMode(); 
        var targetScroll = getTargetScroll(target, isHorizontal);
  
  
        if (isHorizontal) {
          scrollContainer.animate({ scrollLeft: targetScroll }, 600);
        } else {
          scrollContainer.animate({ scrollTop: targetScroll }, 600);
        }
  
        $(".btn-scroll-quickview").removeClass("active");
        $(this).addClass("active");
        activescrollBtn = $(this);
      } else {
        console.error("Target not found for scroll:", scroll);
      }
    });
  
    scrollContainer.on("scroll", function () {  
      var isHorizontal = isHorizontalMode(); 
  
      $(".item-scroll-quickview").each(function () {
        var targetStart = getTargetScroll($(this), isHorizontal) - offsetTolerance;
        var targetEnd = targetStart + (isHorizontal ? $(this).outerWidth() : $(this).outerHeight()) + offsetTolerance;
  
        var currentScroll = isHorizontal
          ? scrollContainer.scrollLeft()
          : scrollContainer.scrollTop();
  
        if (currentScroll >= targetStart && currentScroll < targetEnd) {
          var scroll = $(this).data("scroll-quickview");
  
          $(".btn-scroll-quickview").removeClass("active");
          $(`.btn-scroll-quickview[data-scroll-quickview='${scroll}']`).addClass(
            "active"
          );
        }
      });
    });


  };
  
  var hoverVideo = function () {
    $('.collection-social').each(function () {
        const container = $(this); 
        const video = container.find('video'); 
        const poster = container.find('.poster'); 

        container.on('mouseenter', function () {
            if (video[0].readyState >= 3) { 
                poster.addClass('hide'); 
                video[0].play();
            } else {
                console.warn("Video not ready");
            }
        });
        container.on('mouseleave', function () {
            video[0].pause(); 
            poster.removeClass('hide'); 
        });
    });
  };


  /* hoverPin
  -------------------------------------------------------------------------*/
  var hoverPin = function () {
    if ($(".wrap-lookbook-hover").length) {
      $(".bundle-pin-item").on("mouseover", function () {
        $(".bundle-hover-wrap").addClass("has-hover");
        var $el = $("." + this.id).show();
        $(".bundle-hover-wrap .bundle-hover-item")
          .not($el)
          .addClass("no-hover");
      });
      $(".bundle-pin-item").on("mouseleave", function () {
        $(".bundle-hover-wrap").removeClass("has-hover");
        $(".bundle-hover-item").removeClass("no-hover");
      });
    }
  };

  // togglePassword
  var togglePassword = function () {
    $(".form-has-password")
      .find(".toggle-password")
      .on("click", function () {
        const $passwordInput = $(this)
          .closest(".password-item")
          .find(".input-password");
        const type =
          $passwordInput.attr("type") === "password" ? "text" : "password";
        $passwordInput.attr("type", type);
        $(this).toggleClass("unshow");
      });
  };

  // custom dropdown mobile
  var customDropdown = function () {
    function updateDropdownClass() {
      const $dropdown = $(".dropdown-custom");

      if ($(window).width() <= 991) {
        $dropdown.addClass("dropup").removeClass("dropend");
      } else {
        $dropdown.addClass("dropend").removeClass("dropup");
      }
    }
    updateDropdownClass();
    $(window).resize(updateDropdownClass);
  };

  // loadmore
  var loadMoreSearch = function () {
    if ($(".loadmore-item").length > 0) {
      var display = $(".loadmore-item").data("display");
      var count = $(".loadmore-item").data("count");
      $(".fl-item").slice(0, display).show();
  
      $(".btn-loadmore").on("click", function () {
        setTimeout(() => {
          $(".fl-item:hidden").slice(0, count).show();
          if ($(".fl-item:hidden").length == 0) {
            $(".view-more-button").hide();
          }
          updateHeight();
        }, 300);
      });
    }
  
    function updateHeight() {
      var firstItem = $(".fl-item").first();
      if (firstItem.length) {
        var height = firstItem.height();
        if (height > 0) {
          $(".modal-search .tf-grid-layout").height(height);
        } else {
          setTimeout(updateHeight, 100); 
        }
      }
    }
  
    $(window).on("load", function () {
      // setTimeout(updateHeight, 300); 
      updateHeight();
    });
  
    $(window).resize(function () {
      // setTimeout(updateHeight, 300); 
      updateHeight();
    });
    var observer = new MutationObserver(() => {
      updateHeight();
    });
    var target = document.querySelector(".loadmore-item");
    if (target) {
      observer.observe(target, { childList: true, subtree: true });
    }
  };
  
  var hoverImgCursor = function (){
    let offsetX = 20; 
    let offsetY = 20; 
    $(".hover-cursor-img").on("mousemove", function (e) {
      let hoverImage = $(this).find(".hover-image");
      hoverImage.css({
        top: e.clientY + offsetY + "px",
        left: e.clientX + offsetX + "px",
      });
    });

    $(".hover-cursor-img").on("mouseenter", function () {
      let hoverImage = $(this).find(".hover-image");
      hoverImage.css({
        transform: "scale(1)",
        opacity: 1,
      });
    });

    $(".hover-cursor-img").on("mouseleave", function () {
      let hoverImage = $(this).find(".hover-image");
      hoverImage.css({
        transform: "scale(0)", 
        opacity: 0, 
      });
    });
  }
  


  /* has purchased
  ------------------------------------------------------------------------------------- */
  var hasPurchased = function () {
    if ($(".tf-has-purchased").length > 0) {
      let closedManually = false;
      let interval;

      function showNotification() {
        if (!closedManually) {
          $(".tf-has-purchased").addClass("active");

          setTimeout(function () {
            $(".tf-has-purchased").removeClass("active");
          }, 6000);
        }
      }
      setTimeout(showNotification, 6000);
      interval = setInterval(showNotification, 10000);

      $(".tf-has-purchased-close").on("click", function () {
        $(".tf-has-purchased").removeClass("active");
        closedManually = true;
        clearInterval(interval);
      });
    }
  };

  var handleProgress = function () {
    if ($(".progress-cart").length > 0) {
      var progressValue = $(".progress-cart .value").data("progress");
      setTimeout(function () {
        $(".progress-cart .value").css("width", progressValue + "%");
      }, 1000);
    }

    if ($(".modal-shopping-cart").length > 0) {
      $('.modal-shopping-cart').on('hide.bs.modal', function () {
        $(".tf-progress-bar .value").css("width", "0%");
      });
      $('.modal-shopping-cart').on('show.bs.modal', function () {
        setTimeout(function () {
          var progressValue = $(".tf-progress-bar .value").data("progress");
          $(".tf-progress-bar .value").css("width", progressValue + "%");
        }, 600);
      });
    }
  }

  var heightModalmenu = function () {
    function height() {
      var height = $('header .row-demo .demo-item').first().outerHeight();
      $('header .mega-menu .row-demo').height(height * 2 + 22);
    }
    height();
    $(window).resize(function () {
      height();
    });
  }

  /* footer accordion
  -------------------------------------------------------------------------*/
  var handleFooter = function () {
    var footerAccordion = function () {
      var args = { duration: 250 };
      $(".footer-heading-mobile").on("click", function () {
        $(this).parent(".footer-col-block").toggleClass("open");
        if (!$(this).parent(".footer-col-block").is(".open")) {
          $(this).next().slideUp(args);
        } else {
          $(this).next().slideDown(args);
        }
      });
    };
    function handleAccordion() {
      if (matchMedia("only screen and (max-width: 767px)").matches) {
        if (!$(".footer-heading-mobile").data("accordion-initialized")) {
          footerAccordion();
          $(".footer-heading-mobile").data("accordion-initialized", true);
        }
      } else {
        $(".footer-heading-mobile").off("click");
        $(".footer-heading-mobile").parent(".footer-col-block").removeClass("open");
        $(".footer-heading-mobile").next().removeAttr("style");
        $(".footer-heading-mobile").data("accordion-initialized", false);
      }
    }
    handleAccordion();
    window.addEventListener("resize", function () {
      handleAccordion();
    });
  };

    /* preloader
  -------------------------------------------------------------------------------------*/
  const preloader = function () {
    if ($("body").hasClass("preload-wrapper")) {
      setTimeout(function () {
        $(".preload").fadeOut("slow", function () {
          $(this).remove();
        });
      }, 100);
    }
  };



  // Dom Ready
  $(function () {
    selectImages();
    btnQuantity();
    delete_file();
    goTop();
    closeAnnouncement();
    sidebar_mb();
    tabs();
    swatchColor();
    changeValue();
    totalPriceVariant();
    btn_loading();
    loadItem();
    stagger_wrap();
    clickModalSecond();
    headerSticky();
    autoPopup();
    rangePrice();
    clickControl();
    checkClick();
    variantPicker();
    scrollGridProduct();
    hoverPin();
    togglePassword();
    customDropdown();
    ajaxContactForm();
    loadMoreSearch();
    hasPurchased();
    checkPaymentCard();
    handleFooter();
    handleProgress();
    heightModalmenu();
    scrollQuickView();
    hoverVideo();
    hoverImgCursor();
    ajaxSubscribe.eventLoad();
    new WOW().init();
    preloader();
    
  });
})(jQuery);



