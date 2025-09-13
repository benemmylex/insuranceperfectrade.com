// THIS FILE IS GENERATED. DO NOT EDIT.
(function() {
  function loaded() {
    var name = ".coingecko-coin-price-chart-widget";
    var allElements = document.querySelectorAll(name);
    console.log(allElements.length);
    allElements.forEach(element => {
      var data = {};
      [].forEach.call(element.attributes, function(attr) {
        if (/^data-/.test(attr.name)) {
          var camelCaseName = attr.name.substr(5);
          data[camelCaseName] = attr.value;
        }
      });
      var el = document.createElement("coingecko-coin-price-chart-widget");
      Object.keys(data).forEach(function(name) {
        el.setAttribute(name, data[name]);
      });
      element.appendChild(el);
    });
  }

  var script = document.createElement("script");
  script.src = "https://widgets.coingecko.com/coingecko-coin-price-chart-widget.js";
  document.head.appendChild(script);
  script.onload = function() {
    loaded();
  };
})();
