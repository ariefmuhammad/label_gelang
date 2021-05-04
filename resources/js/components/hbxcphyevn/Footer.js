import React, { Component } from "react";

class Footer extends Component {
    render() {
        return (
            <div className="app-wrapper-footer">
                <div className="app-footer">
                    <div className="app-footer__inner">
                        <div className="app-footer-left">
                            <ul className="nav">
                                <li className="nav-item">
                                    <a
                                        href="http://rumahsakit.untan.ac.id/"
                                        className="nav-link text-info"
                                    >
                                        Rumah Sakit Universitas Tanjungpura
                                    </a>
                                </li>
                                <li className="nav-item">
                                    <a href="#" className="nav-link text-info">
                                        Copyright &copy; 2020
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div className="app-footer-right">
                            <ul className="nav">
                                <li className="nav-item">
                                    <a href="#" className="nav-link text-info">
                                        IT RS UNTAN
                                    </a>
                                </li>
                                <li className="nav-item nav-link">
                                    <div className="badge badge-info mr-1 ml-0">
                                        <small>IT</small>
                                    </div>
                                    <a 
                                        href="http://masariuman.xyz"
                                        target="blank"
                                        className="text-info"
                                    >
                                        Arif Setiawan
                                    </a>
                                    <a 
                                        href="#"
                                        target="blank"
                                        className="text-info"
                                    >
                                    &nbsp;| M. Arief Maulana&nbsp;
                                    </a>
                                    <div className="badge badge-info mr-1 ml-0">
                                        <small>TI</small>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Footer;
