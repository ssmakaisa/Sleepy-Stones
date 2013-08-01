var Wall = {
  $wall:       null,
  $toggle:     null,
  body_height: null,

  init: function()
  {
    Wall.$wall   = $("#photo_wall");
    Wall.$toggle = $("#photo_wall_toggle");

    Wall.$toggle.bind('click', Wall.performToggle);
    $(window).resize(Wall.handleResize);
    $("#photo_wall_photos").niceScroll({ cursorcolor:"#000" });
    $(window).trigger('resize');

    Wall.toHiddenPosition();
    return true;
  },

  // move panel to the hidden position, with toggle button just visible
  toHiddenPosition: function()
  {
    Wall.$wall.css('marginTop', Wall.getPanelMarginWhenHidden());
  },

  // Perform an animated hiding of the panel
  performToggle: function(e)
  {
    e.preventDefault();
    Wall.$wall.animate({ marginTop: Wall.getNewPanelTop() }, function()
    {
      Wall.$wall.toggleClass("visible")
    });
  },

  getNewPanelTop: function()
  {
    return Wall.$wall.hasClass("visible")
      ? Wall.getPanelMarginWhenHidden()
      : 0;
  },

  getPanelMarginWhenHidden: function()
  {
    return -1 * Wall.$wall.height() //+ 30
  },

  isVisible: function()
  {
    return Wall.$wall.hasClass('visible');
  },

  handleResize: function()
  {
    Wall.$wall.css('height', $("body").height()); //- 30

    // ensure the panel is at the correct top position
    // when user resizes browser window, locks the hidden position to the top.
    if(!Wall.isVisible())
    {
      Wall.toHiddenPosition();
    }

    // keep photos container from overlapping the button
    $("#photo_wall_photos").css('height', Wall.$wall.height()); //-35
    $("#photo_wall_photos").getNiceScroll().resize();
    return true;
  }
};

$(document).ready(function()
{
  Wall.init();
});