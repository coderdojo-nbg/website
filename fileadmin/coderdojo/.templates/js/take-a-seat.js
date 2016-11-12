$(document).ready(function () {
  $('.ce-carousel').owlCarousel({
    items: 4,
    itemsScaleUp: false,
    itemsDesktop: [1800, 3],
    itemsDesktopSmall: [1200, 2],
    itemsTablet: [600, 1],
    itemsMobile: false
  });

  // Summenkalkulation
  var colors = $('.color input[type=number]');

  Number.prototype.formatMoney = function (c, d, t) {
    var n = this,
      c = isNaN(c = Math.abs(c)) ? 2 : c,
      d = d == undefined ? "." : d,
      t = t == undefined ? "," : t,
      s = n < 0 ? "-" : "",
      i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
      j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
  };

  function calculateSums() {
    var amount = 0;
    colors.each(function () {
      amount += parseInt($(this).val());
    });
    var gross = amount * 100;
    var net = Math.round(amount * 8403) / 100;
    var vat = Math.round((gross - net) * 100) / 100;
    $('#net').text(net.formatMoney(2, ',', '.'));
    $('#gross').text(gross.formatMoney(2, ',', '.'));
    $('#vat').text(vat.formatMoney(2, ',', '.'));
  }

  colors.change(calculateSums);

  // Initialize tooltips
  $('.tooltip').each(function () {
    $this = $(this);
    $this.attr('aria-label', this.title);
    this.removeAttribute('title');
    this.title = '';
    this.tabindex = 0;
    $this.attr('tabindex', 0);
  });
});

$(window).load(function () {
  // Jump to the first error (if any)
  $('div.error').each(function () {
    var label = $(this).prevAll('label,.label');
    if (label.length) {
      $(window).scrollTo(label);
      return false;
    }
  });

  // Animated document title
  var $counter = $('.counter div');
  if ($counter.length) {
    var pos = 0;
    var title = [];
    $counter.each(function (index, counter) {
      title.push(counter.textContent || counter.innerText);
    });
    title.push(document.title);
    title.push('');
    title = title.join(' ☯ ');
    window.setInterval(function () {
      document.title = title.substring(pos, title.length) + ' ' + title.substring(0, pos++);
      if (pos > title.length) {
        pos = 0;
      }
    }, 100);
  }
});

