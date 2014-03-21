function varargout = occupancy_gui(varargin)
% OCCUPANCY_GUI MATLAB code for occupancy_gui.fig
%      OCCUPANCY_GUI, by itself, creates a new OCCUPANCY_GUI or raises the existing
%      singleton*.
%
%      H = OCCUPANCY_GUI returns the handle to a new OCCUPANCY_GUI or the handle to
%      the existing singleton*.
%
%      OCCUPANCY_GUI('CALLBACK',hObject,eventData,handles,...) calls the local
%      function named CALLBACK in OCCUPANCY_GUI.M with the given input arguments.
%
%      OCCUPANCY_GUI('Property','Value',...) creates a new OCCUPANCY_GUI or raises the
%      existing singleton*.  Starting from the left, property value pairs are
%      applied to the GUI before occupancy_gui_OpeningFcn gets called.  An
%      unrecognized property name or invalid value makes property application
%      stop.  All inputs are passed to occupancy_gui_OpeningFcn via varargin.
%
%      *See GUI Options on GUIDE's Tools menu.  Choose "GUI allows only one
%      instance to run (singleton)".
%
% See also: GUIDE, GUIDATA, GUIHANDLES

% Edit the above text to modify the response to help occupancy_gui

% Last Modified by GUIDE v2.5 22-Mar-2014 16:57:37

% Begin initialization code - DO NOT EDIT
gui_Singleton = 1;
gui_State = struct('gui_Name',       mfilename, ...
                   'gui_Singleton',  gui_Singleton, ...
                   'gui_OpeningFcn', @occupancy_gui_OpeningFcn, ...
                   'gui_OutputFcn',  @occupancy_gui_OutputFcn, ...
                   'gui_LayoutFcn',  [] , ...
                   'gui_Callback',   []);
if nargin && ischar(varargin{1})
    gui_State.gui_Callback = str2func(varargin{1});
end

if nargout
    [varargout{1:nargout}] = gui_mainfcn(gui_State, varargin{:});
else
    gui_mainfcn(gui_State, varargin{:});
end
% End initialization code - DO NOT EDIT


% --- Executes just before occupancy_gui is made visible.
function occupancy_gui_OpeningFcn(hObject, eventdata, handles, varargin)
% This function has no output args, see OutputFcn.
% hObject    handle to figure
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)
% varargin   command line arguments to occupancy_gui (see VARARGIN)

% Choose default command line output for occupancy_gui
handles.output = hObject;

% Update handles structure
guidata(hObject, handles);

% UIWAIT makes occupancy_gui wait for user response (see UIRESUME)
% uiwait(handles.figure1);


% --- Outputs from this function are returned to the command line.
function varargout = occupancy_gui_OutputFcn(hObject, eventdata, handles) 
% varargout  cell array for returning output args (see VARARGOUT);
% hObject    handle to figure
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Get default command line output from handles structure
varargout{1} = handles.output;


% --- Executes on button press in Stop.
function Stop_Callback(hObject, eventdata, handles)
% hObject    handle to Stop (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)
fclose(s2);
clc;
clear all;
close all;

% --- Executes on button press in Start.
function Start_Callback(hObject, eventdata, handles)
% hObject    handle to Start (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)
eigen_prediction;


function in_Callback(hObject, eventdata, handles)
% hObject    handle to in (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of in as text
%        str2double(get(hObject,'String')) returns contents of in as a double
set(handles.in,'String',ocupancy_data(1));

% --- Executes during object creation, after setting all properties.
function in_CreateFcn(hObject, eventdata, handles)
% hObject    handle to in (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function out_Callback(hObject, eventdata, handles)
% hObject    handle to out (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of out as text
%        str2double(get(hObject,'String')) returns contents of out as a double
set(handles.edit1,'String',ocupancy_data(2));

% --- Executes during object creation, after setting all properties.
function out_CreateFcn(hObject, eventdata, handles)
% hObject    handle to out (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function pir1_Callback(hObject, eventdata, handles)
% hObject    handle to pir1 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of pir1 as text
%        str2double(get(hObject,'String')) returns contents of pir1 as a double
set(handles.edit1,'String',ocupancy_data(3));

% --- Executes during object creation, after setting all properties.
function pir1_CreateFcn(hObject, eventdata, handles)
% hObject    handle to pir1 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function pir2_Callback(hObject, eventdata, handles)
% hObject    handle to pir2 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of pir2 as text
%        str2double(get(hObject,'String')) returns contents of pir2 as a double
set(handles.edit1,'String',ocupancy_data(4));

% --- Executes during object creation, after setting all properties.
function pir2_CreateFcn(hObject, eventdata, handles)
% hObject    handle to pir2 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end


% --- Executes during object creation, after setting all properties.
function axes1_CreateFcn(hObject, eventdata, handles)
% hObject    handle to axes1 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: place code in OpeningFcn to populate axes1
