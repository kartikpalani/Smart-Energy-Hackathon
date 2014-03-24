Team Members:   Sourav Maitra
		Swapnil Jaiswal
		Abhay Gajbhiye

Idea: Our idea is to optimize AC energy consumption.Air Leakage via window causes a good amount of power consumption for AC's.So we put LDR sensors in the windows of a room to check whether the window is open or not.If any of the window is open we prompt the User to close the window in order to Switch on the AC.Corresponding to each Window there is a LED in a console which glows if the Window is on.We also show the message to which of the window is on via HTML.It also has a manual override switch which enables the User to keep the AC switched on even if windows are open.So the main USP of our idea is simplicity(very iasy to implement and deploy),cost effectiveness(Cheap sensors are used),scalability(can be easily deployed in a room having any number of windows),impact(It reduces significant amount of current consumption,payback period is very less).

Future Scope: 1.We can use this to meet the security purpose of any building i.e we can notify the security which of the windows is open in a 			building.
              2.We can automate the closing of Window pane.

Implementation: We have 2 LDR sensors put in 2 windows.We put the values of this LDR's in our audrino and depending on the value (if both of them are below threshold that implies windows are closed) we make one of the digital pin low.We take this pin value and put it on the relay circuit.We are indicating the AC via a Light Bulb. We connect the Bulb with the relay.Now the Bulb glows if both LDR values are less than the threshold value(means both the windows are open).





