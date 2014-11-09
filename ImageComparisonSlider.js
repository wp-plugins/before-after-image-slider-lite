window.Scrobbleme = {
    widthToScaleUp: 300,
    methods: ['overlay'],
    versions: {
        'ImageComparisonSlider': '1.9'
    }
};

Scrobbleme.ImageComparisonSlider = function (element, jQuery) {
    var slide, slider, height = 0;

    if (jQuery == undefined) {
        jQuery = window.jQuery;
    }

    this.domNode = jQuery(element);
    this.domNode.originalWidth = this.domNode[0].style.width;
    this.domNode.find('.images .left').width(this.domNode.width() / 2);
    this.domNode.find('.images img').width(this.domNode.width());
    slide = this.slide_overlay;
    slider = this.domNode.find('.slider');
    slider.noUiSlider({
            start: 50,
            range: {
                'min': 0,
                'max': 100
            }
        }
    ).on({
            slide: function (event, value) {
                this.domNode.attr('data-ic-slider-value', value);
                jQuery.proxy(slide, this)(event, {value: value});
            }.bind(this)});
    jQuery.proxy(slide, this)(null, {value: 50});
    jQuery.proxy(this.resize_callback, this)({data: {'slider': slider, 'slide': slide, 'element': this }});
    jQuery(window).resize({'slider': slider, 'slide': slide, 'element': this }, this.resize_callback);
    this.domNode.find('.images').click({'slider': slider, 'slide': slide}, this.clickable_callback.bind(this));

    /** Extras */
    if (this.domNode.hasClass('hover') && this.supports_hover()) {
        this.domNode.find('.images').mousemove({'slider': slider, 'slide': slide}, this.clickable_callback.bind(this));
    }
}
;

Scrobbleme.ImageComparisonSlider.prototype = {

    slide_overlay: function (event, ui) {
        this.domNode.find('.images .left').width(ui.value * this.domNode.width() / 100);
    },

    clickable_callback: function (event) {
        var newValue = (event.pageX - jQuery(event.currentTarget).offset().left) / event.currentTarget.clientWidth * 100;
        jQuery.proxy(event.data.slide, this)(null, {value: newValue});
        event.data.slider.val(newValue);
    },

    resize_callback: function (options) {
        var data = options.data;
        var domNode = data.element.domNode;
        if (domNode.width() <= Scrobbleme.widthToScaleUp && !domNode.modeChanged) {
            domNode.modeChanged = true;
            domNode[0].style.width = '100%';
            domNode.upperSizeBound = domNode.width();
        } else if (domNode.modeChanged && domNode.width() > domNode.upperSizeBound) {
            domNode[0].style.width = domNode.originalWidth;
            domNode.modeChanged = false;
        }

        domNode.find('.images img').height('auto');
        if (domNode.hasClass('overlay')) {
            domNode.find('.images .left').width(domNode.width() / 2);
            domNode.find('.images img').width(domNode.width());
        }
        var currentValue = data.slider.val();
        jQuery.proxy(data.slide, data.element)(null, {value: currentValue});
    },

    /**
     * Returns true, if the device supports "hover" in the plugins sense.
     */
    supports_hover: function () {
        return !navigator.userAgent.match(/(iPod|iPhone|iPad|Android|Windows\sPhone|BlackBerry)/i);
    }
};

jQuery(function (jQuery) {
    jQuery('.image-comparator').each(function (index, element) {
        new Scrobbleme.ImageComparisonSlider(element, jQuery);
    });
});