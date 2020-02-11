import React, {Component} from 'react'

class Yatri_Tools_Elementor_Modal_Tab_Blocks_Component extends Component {
    render() {
        return (
            <div className="yte-templates-modal-body">
                <div className="yte-templates-modal-body-inner">
                    <div className="yte-templates-modal-body-main">
                        <div className="yte-template-views-body">
                            <div className="template-item">
                                {this.props.data.templates.map(block => (
                                    <div key={block.id} className="template-item-inner">
                                        <ul className="template-preview-btn">
                                            <li className="yte-btn yte-btn-preview-big">
                                                <span onClick={() => this.props.onPreview(block)}><i
                                                    className="fas fa-search-plus"></i>&nbsp;Preview</span>
                                            </li>
                                            <li className="yte-btn yte-btn-import">
                                                <span onClick={() => this.props.onClick(block)}><i
                                                    className="far fa-arrow-alt-circle-down"></i>&nbsp;Import</span>
                                            </li>
                                        </ul>
                                        <div className="template-item-figure">
                                            <img src={block.thumbnail} alt=""/>
                                        </div>
                                        <div className="template-item-name"><span>{block.title}</span></div>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

export default Yatri_Tools_Elementor_Modal_Tab_Blocks_Component;