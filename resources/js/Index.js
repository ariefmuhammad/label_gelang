import React, { Component } from "react";
import ReactDOM from "react-dom";
import { BrowserRouter, Switch, Route, Link } from "react-router-dom";
import Setting from "./components/hbxcphyevn/Setting";
import Header from "./components/hbxcphyevn/Header";
import Sidebar from "./components/hbxcphyevn/Sidebar";
import Footer from "./components/hbxcphyevn/Footer";
import Index from "./components/Index";
import Track from "./components/Track";
import Pasien from "./components/Pasien";
// import Lab from "./components/Lab";
import LabBpjs from "./components/LabBpjs";
import LabUmum from "./components/LabUmum";
import LabKlaimCovid from "./components/LabKlaimCovid";
import LabOmega from "./components/LabOmega";
import LabProdia from "./components/LabProdia";
import Radiologi from "./components/Radiologi";
// import Tracer from ".components/Track";

if (document.getElementById("root")) {
    ReactDOM.render(
        <BrowserRouter>
            <Header />
            {/* <Setting /> */}
            <div className="app-main">
                <Sidebar />
                <div className="app-main__outer">
                    <div className="app-main__inner">
                        <Switch>
                            <Route exact path="/tracer" component={Track} />
                            <Route
                                exact
                                path="/today_pasien"
                                component={Pasien}
                            />
                            {/* <Route
                                exact
                                path="/laboratorium"
                                component={Lab}
                            /> */}
                            <Route
                                exact
                                path="/lab_bpjs"
                                component={LabBpjs}
                            />
                            <Route
                                exact
                                path="/lab_umum"
                                component={LabUmum}
                            />
                            <Route
                                exact
                                path="/lab_klaim_covid"
                                component={LabKlaimCovid}
                            />
                            <Route
                                exact
                                path="/lab_omega"
                                component={LabOmega}
                            />
                            <Route
                                exact
                                path="/lab_prodia"
                                component={LabProdia}
                            />
                            <Route
                                exact
                                path="/radiologi"
                                component={Radiologi}
                            />
                            <Index />
                        </Switch>
                    </div>
                    <Footer />
                </div>
            </div>
        </BrowserRouter>,

        document.getElementById("root")
    );
}
