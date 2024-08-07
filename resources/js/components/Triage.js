import React, { Component } from "react";

class Triage extends Component {
    constructor(props) {
        super(props);
        this.state = {
            data: [],
            cari: "",
            // awalan: "%10",
            // tanggal_masuk: ""
        };
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.renderCari = this.renderCari.bind(this);
        // this.awalanChange = this.awalanChange.bind(this);
        // this.tanggalmasukChange = this.tanggalmasukChange.bind(this);
    }

    
    // getTodayDate() {
    //     var today = new Date();
    //     var dd = today.getDate();
    //     var mm = today.getMonth()+1;
    //     var yyyy = today.getFullYear();
    //     if(dd<10){
    //         dd='0'+dd;
    //     }
    //     if(mm<10){
    //         mm='0'+mm;
    //     }
    //     var terbalik = yyyy+'-'+mm+'-'+dd;
    //     return terbalik;
    // }

    // tanggalmasukChange(e) {
    //     this.setState({
    //         tanggal_masuk: e.target.value
    //     });
    // }

    // awalanChange(e) {
    //     this.setState({
    //         awalan: e.target.value
    //     });
    // }

    handleChange(e) {
        this.setState({
            cari: e.target.value
        });
        // console.log(e.target.value);
    }

     handleSubmit(e) {
        e.preventDefault();
         axios
            .post("/triage/data", {
                cari: this.state.cari
            })
            .then(response => {
                this.setState({
                    data: [response.data.cari],
                    cari: "",
                    // awalan: "%10",
                    // tangga2l_masuk: this.getTodayDate()
                });
                console.log("from handle sumit", response);
                // console.log(this.state.data);
            })
            .catch(error => {
                console.log(error.message);
            });
    }      
    

    renderCari() {
        if (!this.state.data[0]) {
            return this.state.data.map(data => (
                <div key="1">DATA TIDAK ADA / PENGISIAN TRIAGE KOSONG</div>
            ));
        } else {
            return this.state.data.map(data => (
                <div key="1">
                    <a
                        href={`/${data.NOPEN}/triage`}
                        className="btn btn-danger btn-xs"
                        target="_blank"
                    >
                        <i className="fa fa-print"></i> Cetak Triage
                    </a>
                    &nbsp;
                    &nbsp;
                    <br></br>
                    <br></br>
                    <div className="table-responsive">
                    <table className="mb-0 table table-bordered">
                        <thead>
                            <tr>
                                <th>NO REG</th>
                                <th>NO RM</th>
                                <th>Nama Pasien</th>
                                <th>Unit</th>
                                <th>DPJP</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Tgl/Jam</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{data.NOPEN}</td>
                                <td className="widthnorm">{data.RM}</td>
                                <td>{data.NAMA_PASIEN}</td>
                                <td>{data.UNIT}</td>
                                <td>{data.DPJP}</td>
                                <td className="widthjkp">{data.JENIS_KELAMIN === 1 ? "Laki-Laki" : "Perempuan"}</td>
                                <td className="widthlahir">{data.TANGGAL_LAHIR}</td>
                                <td>{data.TANGGAL}</td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
                </div>
            ));
        }
    }

    componentDidMount() {
        // this.getTodayDate();
    }

    componentDidUpdate() {
    }

    render() {
        return (
            <div>
                <div className="app-page-title">
                    <div className="page-title-wrapper">
                        <div className="page-title-heading">
                            <div className="page-title-icon">
                                <i className="pe-7s-bandaid icon-gradient bg-deep-blue"></i>
                            </div>
                            <div>
                                Triage
                                <div className="page-title-subheading">
                                    Halaman ini berfungsi untuk mencetak hasil Triage.
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
                                    placeholder="Cari No. Pendaftaran"
                                    required
                                />
                            </div>
                            <button
                                type="submit"
                                className="btn-square btn-hover-shine btn btn-alternate"
                            >
                                <a className="pe-7s-search"></a> CARI / KLIK
                                ENTER UNTUK CARI
                            </button>
                        </form>
                        <hr />
                        <p></p>
                        {this.renderCari()}
                    </div>
                </div>
            </div>
        );
    }
}

export default Triage;
