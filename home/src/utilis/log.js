export default {
  install: (app) => {
    app.config.globalProperties.log = (msg, color = 'white') => {
      color = color || "black";
      let bgc = "darkgreen";
      switch (color) {
        case "success":
          color = "white";
          bgc = "darkgreen";
          break;
        case "info":
          color = "DodgerBlue";
          bgc = "Turquoise";
          break;
        case "error":
          color = "Red";
          bgc = "Black";
          break;
        case "start":
          color = "OliveDrab";
          bgc = "PaleGreen";
          break;
        case "warning":
          color = "Tomato";
          bgc = "Black";
          break;
        case "end":
          color = "Orchid";
          bgc = "MediumVioletRed";
          break;
      }

      if (typeof msg == "object") {
        console.log(msg);
      } else if (typeof color == "object") {
        console.log("%c" + msg, "color: PowderBlue;font-weight:light; background-color: RoyalBlue;");
        console.log(color);
      } else {
        console.log("%c" + msg, "color:" + color + ";font-weight:light; background-color: " + bgc + ";");
      }
    }
  }
}

/**
 log("hey"); // Will be black
 log("Hows life?", "green"); // Will be green
 log("I did it", "success"); // Styled so as to show how great of a success it was!
 log("FAIL!!", "error"); // Red on black!
 var someObject = {prop1: "a", prop2: "b", prop3: "c"};
 log(someObject); // prints out object
 log("someObject", someObject); // prints out "someObect" in blue followed by the someObject
 **/