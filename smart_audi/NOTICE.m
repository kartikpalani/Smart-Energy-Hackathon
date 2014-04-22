function varargout = NOTICE(varargin)
% NOTICE MATLAB code for NOTICE.fig
%      NOTICE, by itself, creates a new NOTICE or raises the existing
%      singleton*.
%
%      H = NOTICE returns the handle to a new NOTICE or the handle to
%      the existing singleton*.
%
%      NOTICE('CALLBACK',hObject,eventData,handles,...) calls the local
%      function named CALLBACK in NOTICE.M with the given input arguments.
%
%      NOTICE('Property','Value',...) creates a new NOTICE or raises the
%      existing singleton*.  Starting from the left, property value pairs are
%      applied to the GUI before NOTICE_OpeningFcn gets called.  An
%      unrecognized property name or invalid value makes property application
%      stop.  All inputs are passed to NOTICE_OpeningFcn via varargin.
%
%      *See GUI Options on GUIDE's Tools menu.  Choose "GUI allows only one
%      instance to run (singleton)".
%
% See also: GUIDE, GUIDATA, GUIHANDLES

% Edit the above text to modify the response to help NOTICE

% Last Modified by GUIDE v2.5 23-Mar-2014 15:57:57

% Begin initialization code - DO NOT EDIT
gui_Singleton = 1;
gui_State = struct('gui_Name',       mfilename, ...
                   'gui_Singleton',  gui_Singleton, ...
                   'gui_OpeningFcn', @NOTICE_OpeningFcn, ...
                   'gui_OutputFcn',  @NOTICE_OutputFcn, ...
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


% --- Executes just before NOTICE is made visible.
function NOTICE_OpeningFcn(hObject, eventdata, handles, varargin)
% This function has no output args, see OutputFcn.
% hObject    handle to figure
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)
% varargin   command line arguments to NOTICE (see VARARGIN)

% Choose default command line output for NOTICE
handles.output = hObject;

% Update handles structure
guidata(hObject, handles);

% UIWAIT makes NOTICE wait for user response (see UIRESUME)
% uiwait(handles.figure1);
global dispText;
set(handles.text1, 'String', dispText)

% --- Outputs from this function are returned to the command line.
function varargout = NOTICE_OutputFcn(hObject, eventdata, handles) 
% varargout  cell array for returning output args (see VARARGOUT);
% hObject    handle to figure
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Get default command line output from handles structure
varargout{1} = handles.output;
