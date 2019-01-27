import React from 'react';
import {render} from 'react-dom';
import { BootstrapTable, TableHeaderColumn } from 'react-bootstrap-table';
import JournalistFilter from './JournalistFilter.jsx';

class Journalists extends React.Component {

  constructor(props) {

    super(props);

    this.state = {
      journalists: [], // effective list to be filtered
      allJournalists: [], // full list for filter options
      categories: [],
      periodicities: [],
      mediaTypes: [],
      provinces: [],
      filters: {
        ranking: '',
        categories: [],
        periodicities: [],
        mediaTypes: [],
        provinces: [],
        nationalCirculation: false,
        whiteList: [],
        blackList: []
      }
    };
  }

  componentDidMount() {
    this.fetchCategoryList();
    this.fetchPeriodicityList();
    this.fetchMediaTypeList();
    this.fetchProvinceList();
    this.fetchAllJournalists();
    this.fetchJournalistList();
  }

  fetchCategoryList() {

    $.post(
      "/index.php/categories/index",
      (data) => {
        this.setState({
          categories: data
        });
    });

  }

  fetchPeriodicityList() {

    $.post(
      "/index.php/journalistic-heads/periodicities",
      (data) => {
        this.setState({
          periodicities: data
        });
    });

  }

  fetchMediaTypeList() {
    $.post(
      "/index.php/media-types",
      (data) => {
        this.setState({
          mediaTypes: data
        });
    });
  }

  fetchProvinceList() {
      let provinces = [];
      $('#hidden-province-option-list option').each(function() {
        var option = $(this);
        if(option.val() !== '') {
          provinces.push({
            'id': option.val(),
            'name': option.text()
          });
        }
      });
      this.setState({
        provinces: provinces
      });
  }

  fetchAllJournalists() {

    $.post(
      "/index.php/journalists",
      (data) => {
      this.setState({
        allJournalists: data
      });
    });

  }

  fetchJournalistList() {

    const filters = this.state.filters;
    const query = {};

    if(filters.ranking != '') {
      query.ranking = filters.ranking;
    }

    if(filters.categories.length) {
      query.categories = filters.categories;
    }

    if(filters.periodicities.length) {
      query.periodicities = filters.periodicities;
    }

    if(filters.mediaTypes.length) {
      query.mediaTypes = filters.mediaTypes;
    }

    query.nationalCirculation = filters.nationalCirculation;

    if(filters.provinces.length) {
      query.provinces = filters.provinces;
    }

    if(filters.blackList.length) {
      query.blackList = filters.blackList;
    }

    if(filters.whiteList.length) {
      query.whiteList = filters.whiteList;
    }

    $.post(
      "/index.php/journalists",
      query,
      (data) => {

      this.setState({
        journalists: data
      });

      // set email address to modal for copy to clipboard
      let emailAdresses = data.map((j) => {
          return j.email;
      });
      $('#email-address-list-text').html(emailAdresses.join(', '));

    });
  }

  onFilterChange() {
    this.fetchJournalistList();
  }

  render() {
    const cellEditingOptions = {
      mode: "dbclick",
      beforeSaveCell: this.updateJournalist
    };

    const selectRowOptions = {
      mode: 'checkbox'
    };

    const onRowClickCallback = (row) => {
      window.location.href = "/index.php/journalists/"+row.id+"/edit";
    }

    const tableOptions = {
      onRowClick: onRowClickCallback,
      onDeleteRow: (result) => console.log(result),
      onAddRow: (result) => console.log(result),
      deleteText: "Elimina",
      insertText: "Crea",
      exportCSVText: 'Esporta come CSV'
    }

    function getCurrentDate() {
      var now = new Date();
      var date = ((now.getDate() < 10)?"0":"") + now.getDate() +"-"+(((now.getMonth()+1) < 10)?"0":"") + (now.getMonth()+1) +"-"+ now.getFullYear();
      var time = ((now.getHours() < 10)?"0":"") + now.getHours() +"."+ ((now.getMinutes() < 10)?"0":"") + now.getMinutes() +"."+ ((now.getSeconds() < 10)?"0":"") + now.getSeconds();
      return date + " " + time;
    }

    function buttonFormatter(cell, row) {
      var link = "/index.php/journalists/"+row.id+"/edit";
      return '<a href="'+link+'" class="btn btn-sm btn-primary" title="modifica"><span class="glyphicon glyphicon-pencil"></span></a>';
    }

    return (
      <div>
        <JournalistFilter filters={this.state.filters} categories={this.state.categories} periodicities={this.state.periodicities} mediaTypes={this.state.mediaTypes} provinces={this.state.provinces} allJournalists={this.state.allJournalists} journalists={this.state.journalists} onFilterChange={this.onFilterChange.bind(this)} />
        <BootstrapTable data={this.state.journalists} bordered={true} striped={true} pagination={true} search={true} options={tableOptions} searchPlaceholder={'Ricerca giornalista'} multiColumnSearch={true} columnFilter={true} hover={true} exportCSV csvFileName={"comunicato_" + getCurrentDate() + '.csv'}>
          {/*<TableHeaderColumn dataField="id" isKey={true} dataAlign="center" dataSort={true}>ID</TableHeaderColumn>*/}
          <TableHeaderColumn dataField="name" dataSort={true}>Nome</TableHeaderColumn>
          <TableHeaderColumn dataField="surname" dataSort={true}>Cognome</TableHeaderColumn>
          <TableHeaderColumn dataField="email" isKey={true} dataSort={true}>E-mail</TableHeaderColumn>
          <TableHeaderColumn dataField="ranking" dataSort={true}>Rank.</TableHeaderColumn>
          <TableHeaderColumn dataField="button" dataFormat={buttonFormatter}></TableHeaderColumn>
        </BootstrapTable>
      </div>
    );

  }
}

let journalistsWrapper = document.getElementById('journalists');
if(journalistsWrapper) {
  render(<Journalists />, journalistsWrapper);
}
