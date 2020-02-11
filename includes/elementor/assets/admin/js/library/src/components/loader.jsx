import React, { Component } from "react"

class Loader extends Component {

    constructor(props) {

        super(props);
        this.state = {
        randomWittyText: 'Please wait...',
        };
    }

    componentDidMount() {

    }

    componentWillUnmount() {
        clearInterval(this.timerInterval);
    }

    render() {
        return (
        <div className="loader-box">
            <div className="yatri-tools-elementor-loader">
            <svg className="circular" viewBox="25 25 50 50">
                <circle className="path" cx={50} cy={50} r={20}  stroke="#D30C5C" fill="transparent" strokeWidth={2} strokeMiterlimit={10} />
            </svg>
            </div>
            <p className="wittiness">{ this.state.randomWittyText }</p>
        </div>
        )
    }
}

export default Loader;