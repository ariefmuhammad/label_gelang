import React, { Component } from "react";

class Track extends Component {
    constructor(props) {
        super(props);
        this.state = {
            data: [],
            pagination: [],
            cari: "",
            url: "/tracer/data"
        };
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.renderCari = this.renderCari.bind(this);
    }

    handleChange(e) {
        this.setState({
            cari: e.target.value
        });
        // console.log(e.target.value);
    }

    handleSubmit(e) {
        e.preventDefault();
        axios
            .post("/tracer/data", {
                cari: this.state.cari
            })
            .then(response => {
                this.setState({
                    data: [response.data.cari],
                    cari: ""
                });
                // console.log("from handle sumit", response);
                // console.log(this.state.data);
            })
            .catch(error => {
                console.log(error.message);
            });
    }

    renderCari() {
        if (!this.state.data[0]) {
            return this.state.data.map(data => (
                <div key="1">DATA TIDAK ADA</div>
            ));
        } else {
            return this.state.data.map(data => (
                <tr key={data.no_rkm_medis}>
                    <th scope="row">{data.nomor}</th>
                    <td>tanggal</td>
                    <td>poli tujuan</td>
                    <td>dokter</td>
                    <td>
                        <a
                            href={`/tracer/${data.no_rkm_medis}/print`}
                            className="btn btn-success btn-xs"
                            target="_blank"
                        >
                            <i className="fa fa-print"></i> Cetak Tracer
                        </a>
                    </td>
                </tr>
            ));
        }
    }

    componentDidMount() {}

    componentDidUpdate() {}

    render() {
        return (
            <div>
                <div className="app-page-title">
                    <div className="page-title-wrapper">
                        <div className="page-title-heading">
                            <div className="page-title-icon">
                                <i className="pe-7s-search icon-gradient bg-happy-green"></i>
                            </div>
                            <div>
                                TRACER
                                <div className="page-title-subheading">
                                    Halaman ini berfungsi untuk manajemen
                                    Tracer.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="main-card mb-3 card">
                    <div className="card-body">
                        <form onSubmit={this.handleSubmit}>
                            <div className="form-group">
                                <input
                                    onChange={this.handleChange}
                                    value={this.state.cari}
                                    className="form-control-lg form-control"
                                    placeholder="Cari Nomor Rekam Medis"
                                    required
                                />
                            </div>
                            <button
                                type="submit"
                                className="btn-square btn-hover-shine btn btn-success"
                            >
                                <a className="pe-7s-search"></a> CARI / KLIK
                                ENTER UNTUK CARI
                            </button>
                        </form>
                        <hr />
                        <p></p>
                        <div className="table-responsive">
                            <table className="mb-0 table">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>TANGGAL</th>
                                        <th>POLI TUJUAN</th>
                                        <th>DOKTER</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>{this.renderCari()}</tbody>
                            </table>
                            {this.state.pagination.next_page_url ? (
                                <button
                                    className="btn-wide mb-2 mr-2 btn-icon btn-icon-right btn-shadow btn-pill btn btn-outline-success"
                                    onClick={this.loadMore}
                                >
                                    More
                                </button>
                            ) : (
                                ""
                            )}
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Track;