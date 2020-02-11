import React, {Component} from 'react'

class Yatri_Tools_Elementor_Modal_Tab_Pages_Component extends Component {

    render() {
        return (
            <div className="yte-templates-modal-body">
                <div className="yte-templates-modal-body-inner">
                    <div className="cta-section yte-templates-modal-body-mid yte-row">
                        <button onClick={() => this.props.onUpdateView('home')} className="back yte-btn">
                            <i className="fas fa-long-arrow-alt-left"></i>&nbsp;Back
                        </button>
                    </div>
                    <div className="yte-templates-modal-body-main">
                        <div className="yte-template-views-body">
                            <div className="template-item">
                                {this.props.data.map(pages => (
                                    <div key={pages.id} className="template-item-inner">
                                        <ul className="template-preview-btn">
                                            <li className="yte-btn yte-btn-preview-big">
                                                <span onClick={() => this.props.onPreview(pages)}><i
                                                    className="fas fa-search-plus"></i>&nbsp;Preview</span>
                                            </li>
                                            <li className="yte-btn yte-btn-import">
                                                <span onClick={() => this.props.onClick(pages)}><i
                                                    className="far fa-arrow-alt-circle-down"></i>&nbsp;Import</span>
                                            </li>
                                        </ul>
                                        <div className="template-item-figure">
                                            <img src={pages.thumbnail} alt=""/>
                                        </div>
                                        <div className="template-item-name"><span>{pages.title}</span></div>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Yatri_Tools_Elementor_Modal_Tab_Pages_Component;