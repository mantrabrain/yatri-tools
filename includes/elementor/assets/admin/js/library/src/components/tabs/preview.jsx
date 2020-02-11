import React, {Component} from 'react'

class Yatri_Tools_Elementor_Modal_Tab_Preview_Component extends Component {

    showFullscreen = () => {
        if (document.fullscreenEnabled || document.webkitFullscreenEnabled || document.mozFullScreenEnabled || document.msFullscreenEnabled) {

            var iframe = document.querySelector('#yatri-tools-elementor-library iframe');
            // Do fullscreen
            if (iframe.requestFullscreen) {
                iframe.requestFullscreen();
            } else if (iframe.webkitRequestFullscreen) {
                iframe.webkitRequestFullscreen();
            } else if (iframe.mozRequestFullScreen) {
                iframe.mozRequestFullScreen();
            } else if (iframe.msRequestFullscreen) {
                iframe.msRequestFullscreen();
            }
        } else {
            alert('Your browser is not supported');
        }
    }

    render() {

        let previousView = (this.props.data.type == "page" ? 'templates' : 'blocks');
        let iframeWidth;
        switch (this.props.iframeType) {
            case 'desktop':
                iframeWidth = {width: "100%"};
                break;
            case 'tablet':
                iframeWidth = {width: "768px"};
                break;
            case 'mobile':
                iframeWidth = {width: "320px"};
                break;
        }
        return (
            <div className="yte-templates-modal-body">
                <div className="yte-templates-modal-body-inner">

                    <div className="cta-section yte-templates-modal-body-mid cta-responsive">
                        <button onClick={() => this.props.onUpdateView(previousView)} className="back yte-btn">
                            <i className="fas fa-long-arrow-alt-left"></i>&nbsp;Back
                        </button>

                        <div className="responsive-controls">
                            <i title="Desktop View" onClick={() => this.props.onResponsive('desktop')}
                               className={`fas fa-laptop ${ this.props.iframeType == "desktop" ? 'active' : '' }`}></i>
                            <i title="Tablet View" onClick={() => this.props.onResponsive('tablet')}
                               className={`fas fa-tablet-alt ${ this.props.iframeType == "tablet" ? 'active' : '' }`}></i>
                            <i title="Mobile View" onClick={() => this.props.onResponsive('mobile')}
                               className={`fas fa-mobile-alt ${ this.props.iframeType == "mobile" ? 'active' : '' }`}></i>
                            <i title="Fullscreen View" onClick={() => this.showFullscreen()}
                               className="fas fa-expand"></i>
                        </div>

                        <span onClick={() => this.props.onClick(this.props.data)} className="back yte-btn">
                            <i className="far fa-arrow-alt-circle-down"></i>&nbsp;Import</span>
                    </div>
                    <div className="yte-templates-modal-body-main preview-section">
                        <iframe style={iframeWidth} src={this.props.data.link} frameBorder={0} allowFullScreen
                                width=""/>
                    </div>
                </div>
            </div>
        )
    }

}

export default Yatri_Tools_Elementor_Modal_Tab_Preview_Component