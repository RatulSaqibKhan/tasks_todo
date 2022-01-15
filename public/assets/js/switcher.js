$(function () {
  var initThemeClass = window.localStorage.getItem('themeClass') || 'bg-theme bg-theme1';
  setTheme(initThemeClass);
  $(".switcher-btn").on("click", function () {
    $(".switcher-wrapper").toggleClass("switcher-toggled")
  });
  $(".close-switcher").on("click", function () {
    $(".switcher-wrapper").removeClass("switcher-toggled")
  });
  var themesObj = {
    '#theme1': 'bg-theme bg-theme1',
    '#theme2': 'bg-theme bg-theme2',
    '#theme3': 'bg-theme bg-theme3',
    '#theme4': 'bg-theme bg-theme4',
    '#theme5': 'bg-theme bg-theme5',
    '#theme6': 'bg-theme bg-theme6',
    '#theme7': 'bg-theme bg-theme7',
    '#theme8': 'bg-theme bg-theme8',
    '#theme9': 'bg-theme bg-theme9',
    '#theme10': 'bg-theme bg-theme10',
    '#theme11': 'bg-theme bg-theme11',
    '#theme12': 'bg-theme bg-theme12'
  };
  
  Object.keys(themesObj).forEach((theme) => {
    $(document).on('click', theme, (e) => {
      setTheme(themesObj[theme])
    })
  });

  function setTheme(themeClass) {
    $('body').attr('class', themeClass);
    window.localStorage.setItem('themeClass', themeClass);
  }
})