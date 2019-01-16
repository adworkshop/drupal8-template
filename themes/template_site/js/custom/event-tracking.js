function eventTrackingDelayed(category,action,label,o) {
  path = o.getAttribute('href');
  eventTracking(category,action,label)
  setTimeout('document.location = "'+path+'" ', 300);
}

function eventTracking(category,action,label,nonInteraction) {
  if (typeof(ga) !== "undefined") {
      if (typeof(nonInteraction) !== "undefined") nonInteraction = false;

      ga('send', 'event', category, action, label, {
          nonInteraction: nonInteraction
      });
  }
}
