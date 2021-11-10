import React, {Component} from 'react'
import Loader from './loader.jsx'
import Yatri_Tools_Elementor_Modal_Component from './modal.jsx'
import Yatri_Tools_Elementor_Modal_Tab_Pages_Component from './tabs/pages.jsx'
import Yatri_Tools_Elementor_Modal_Tab_Blocks_Component from './tabs/blocks.jsx'
import Yatri_Tools_Elementor_Modal_Tab_Preview_Component from './tabs/preview.jsx'

import '../css/grid.css'
import '../css/elementor.css'

class Yatri_Tools_Elementor_Main_Component extends Component {
    constructor(props) {
        super(props)
        this.state = {
            error: null,
            isLoaded: false,
            renderView: 'home',
            preview: [],
            kits: [],
            blocks: [],
            selectedTemplate: [],
            modalData: [],
            responsive: 'desktop'
        }
        // Updates View Globally
        updateView = this.updateView.bind(this)
    }

    componentDidMount() {
        // Fetching Templates & Blocks
        this.updateView('loading');

        try {
            Promise.all([
                fetch(YatriToolsElementorThemesLibrary.apiUrl + "pages.php"),
                fetch(YatriToolsElementorThemesLibrary.apiUrl + "blocks.php")
            ])
                .then(values => Promise.all(values.map(value => value.json())))
                .then(finalVals => {
                    let templates = finalVals[0];
                    let blocks = finalVals[1];
                    this.setState({
                        isLoaded: true,
                        modalData: templates.data,
                        kits: templates.data.templates,
                        blocks: blocks.data,
                        renderView: 'home'
                    });
                })
        } catch {
            console.log("Something went wrong!");
        }
    }

    updateView = (view) => {
        if (view != this.state.renderView) {
            this.setState({
                renderView: view
            })
        }
    }
    showKit = (templates) => {
        this.setState({
            selectedTemplate: templates
        });
        this.updateView('templates');
    }

    showDemo = (preview) => {
        this.setState({
            renderView: 'preview',
            preview: preview
        })
    }

    importJson = (item) => {

        this.updateView('loading');
        // Installing Template
        fetch(YatriToolsElementorThemesLibrary.ajaxurl, {
            method: 'POST',
            headers: new Headers({'Content-Type': 'application/x-www-form-urlencoded'}),
            body: 'action=yatri_tools_elementor_fetch_tmpl_data&item_id=' + item.id
        }).then(response => response.json())
            .then((tmpl) => {
                window.yatriToolsElementorModal.hide();
                elementor.getPreviewView().addChildModel(tmpl.data.template.content);

                window.$e.internal('document/save/set-is-modified', {
                    status: true
                });
              
                this.updateView('home');
            })
            .catch(function (error) {
                debugger;
                console.log('Something went wrong!');
                console.log(JSON.stringify(error));
            });
    }

    responsiveIframe = (type) => {
        this.setState({
            responsive: type
        })
    }

    createView = (view) => {

        switch (view) {
            case 'home':
                return <Yatri_Tools_Elementor_Modal_Component data={this.state.modalData}
                                                              onClick={(templates) => this.showKit(templates)}/>
            case 'templates':
                return <Yatri_Tools_Elementor_Modal_Tab_Pages_Component
                    onUpdateView={(view) => this.updateView(view)}
                    data={this.state.selectedTemplate} onClick={(item) => this.importJson(item)}
                    onPreview={(url) => this.showDemo(url)}/>
            case 'blocks':
                return <Yatri_Tools_Elementor_Modal_Tab_Blocks_Component data={this.state.blocks}
                                                                         onClick={(item) => this.importJson(item)}
                                                                         onPreview={(url) => this.showDemo(url)}/>
            case 'preview':
                return <Yatri_Tools_Elementor_Modal_Tab_Preview_Component
                    onUpdateView={(view) => this.updateView(view)} data={this.state.preview}
                    onClick={(item) => this.importJson(item)}
                    onResponsive={(type) => this.responsiveIframe(type)}
                    iframeType={this.state.responsive}/>
            case 'loading':
                return <Loader/>
        }
    }

    closeModal = () => {
        window.yatriToolsElementorModal.hide();
        setTimeout(() => {
            this.updateView('home');
        }, 500);
    }

    static getDerivedStateFromError(error) {
        // Update state so the next render will show the fallback UI.
        return {error: true};
    }

    render() {

        const {error, isLoaded, kits, blocks, renderView} = this.state;

        if (error) {
            return <div>Error: {error.message}</div>;
        } else if (!isLoaded) {
            return <Loader/>
        } else {
            let logo = YatriToolsElementorThemesLibrary.baseUrl + '/assets/images/yatri-full-logo.png';

            return (
                <div id="yte-templates-modal" className="yte-templates-modal">
                    <div className="yte-templates-modal-inner yte-container">

                        <div className="yte-templates-modal-header">
                            <div className="yte-col-sm-3">
                                <div className="brand-logo">
                                    <img src={logo} title="Yatri Library"/>
                                </div>
                            </div>
                            <div className="yte-col-sm-6">
                                <div className="yte-templates-modal-header-top-tabs">
                                    <ul className="top-tabs-inner">
                                        <li onClick={() => this.updateView('home')}
                                            className={`top-tabs-temp ${renderView == "home" || renderView == "templates" ? 'active' : ''}`}>Templates <span
                                            className="top-tabs-numb">{kits.length}</span></li>

                                        <li onClick={() => this.updateView('blocks')}
                                            className={`top-tabs-kits ${renderView == "blocks" ? 'active' : ''}`}>Blocks <span
                                            className="top-tabs-numb">{blocks.templates.length}</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div className="yte-col-sm-3">
                                <div className="yte-templates-modal-header-top-right">
                                    <ul className="top-right">
                                        <li className="top-right-list">
                                            <div className="icon" onClick={() => this.closeModal()}>
                                                <i className="eicon-close"></i>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {this.createView(this.state.renderView)}

                    </div>
                </div>
            );
        }
    }
}

export default Yatri_Tools_Elementor_Main_Component

function updateView(view) {
    if (view != this.state.renderView) {
        this.setState({
            renderView: view
        })
    }
}