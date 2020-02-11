import React, {Component} from 'react'

class Yatri_Tools_Elementor_Modal_Component extends Component {

    render() {
        return (
            <div className="yte-templates-modal-body">
                <div className="yte-templates-modal-body-inner">
                    <div className="yte-templates-modal-body-main">
                        <div className="template-item">
                            {this.props.data.templates.map(item => (
                                <div key={item.id} className="template-item-inner">
                                    <ul className="template-btn-group">
                                        <span className="template-btn-item yte-btn yte-btn-preview"
                                              onClick={() => this.props.onClick(item.pages ? item.pages : [item])}><i
                                            className="fas fa-search-plus"></i>&nbsp;Preview</span>
                                    </ul>
                                    <div className="template-item-figure">
                                        <img src={item.thumbnail} alt="template-thumbnail"/>
                                    </div>
                                    <div className="template-item-name">
                                        <span className="page-title">{item.title}</span>
                                        <span
                                            className="page-count"> {item.pages ? item.pages.length + " Pages" : 1 + " Page"}</span>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>

                </div>
            </div>
        );
    }
}

export default Yatri_Tools_Elementor_Modal_Component