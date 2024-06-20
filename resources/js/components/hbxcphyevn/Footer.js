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
                                        href="https://rsuntan.co.id/"
                                        className="nav-link text-dark"
                                    >
                                        Rumah Sakit Universitas Tanjungpura
                                    </a>
                                </li>
                                <li className="nav-item">
                                    <a href="#" className="nav-link text-dark">
                                        Copyright &copy; 2020
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div className="app-footer-right">
                            <ul className="nav">
                                <li className="nav-item">
                                    <a href="#" className="nav-link text-dark">
                                        IT RS UNTAN
                                    </a>
                                </li>
                                <li className="nav-item nav-link">
                                    <div className="badge badge-dark mr-1 ml-0">
                                        <small>IT</small>
                                    </div>
                                    <a 
                                        href="http://masariuman.xyz"
                                        target="blank"
                                        className="text-dark"
                                    >
                                        Arif Setiawan
                                    </a>
                                    <a 
                                        href="#"
                                        target="blank"
                                        className="text-dark"
                                    >
                                    &nbsp;| M. Arief Maulana&nbsp;
                                    </a>
                                    <div className="badge badge-dark mr-1 ml-0">
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
