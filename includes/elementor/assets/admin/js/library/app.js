import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import Yatri_Tools_Elementor_Main_Component from './src/components/main.jsx';

class Yatri_Tools_Elementor_Themes_Library_Class{
    constructor() {
        this.initiatedLibrary = false;
    }

    callback(mutationsList, observer) {

        var _libraryExists = document.getElementById('yatri-tools-elementor-library');
        if( _libraryExists !== null && !this.initiatedLibrary) {
            this.initiatedLibrary = true;
            ReactDOM.render(<Yatri_Tools_Elementor_Main_Component /> , document.getElementById('yatri-tools-elementor-library'));
        } else {
            this.initiatedLibrary = false;
        }

    };
    
    init() {
        const observer = new MutationObserver(this.callback);
        observer.observe(document, { attributes: true, childList: true, subtree: true });
    };
};

var yatriToolsElementorLibraryInstance = new Yatri_Tools_Elementor_Themes_Library_Class();
yatriToolsElementorLibraryInstance.init();