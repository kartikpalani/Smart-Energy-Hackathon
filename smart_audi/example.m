function example 
       myimage = imread('eight.tif');
       roiwindow = CROIEditor(myimage);

       addlistener(roiwindow,'MaskDefined',@your_roi_defined_callback)

       function your_roi_defined_callback(h,e)
            [mask, labels, n] = roiwindow.getROIData;
            delete(roiwindow); 
       end
end