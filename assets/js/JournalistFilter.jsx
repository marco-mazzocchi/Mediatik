import React from 'react';
import { Button, Checkbox, Form, Row, Col, FormGroup, ControlLabel, FormControl, HelpBlock } from 'react-bootstrap';

class JournalistFilter extends React.Component {

  constructor(props) {
    super(props);
  }

  getValidationState() {
    let value = this.props.filters.ranking;
    if(value !== '') {
      value = parseInt(value);
    }

    // don't show anything if value is correct
    if (value == '' || (Number.isInteger(value) && value < 11)) {
      return 'success';
    }
    else {
      return 'error';
    }
  }

  componentDidMount() {
    let self = this;
    $('#categories').chosen().change(function() {
     self.props.filters.categories = $(this).val();
    });
    $('#periodicities').chosen().change(function() {
     self.props.filters.periodicities = $(this).val();
    });
    $('#media-types').chosen().change(function() {
     self.props.filters.mediaTypes = $(this).val();
    });
    $('#provinces').chosen().change(function() {
     self.props.filters.provinces = $(this).val();
    });
    $('#black-list').chosen().change(function() {
     self.props.filters.blackList = $(this).val();
    });
    $('#white-list').chosen().change(function() {
     self.props.filters.whiteList = $(this).val();
    });
  }

  componentDidUpdate(prevProps, prevState) {
    $('#periodicities').trigger("chosen:updated");
    $('#categories').trigger("chosen:updated");
    $('#media-types').trigger("chosen:updated");
    $('#provinces').trigger("chosen:updated");
    $('#black-list').trigger("chosen:updated");
    $('#white-list').trigger("chosen:updated");
  }

  handleRankingChange(e) {
    this.props.filters.ranking = e.target.value;
  }

  handleNationalCirculationChange(e) {
    this.props.filters.nationalCirculation = e.target.checked;
  }

  handleFilterSubmit() {
    // if there is no error emit the change event
    if(this.getValidationState() != 'error') {
      this.props.onFilterChange();
    }
  }

  render() {

    let categoryOptions = '';
    if(this.props.categories.length) {
      categoryOptions = this.props.categories.map((cat, index) => {
          return <option key={ index } value={ cat.id }>{ cat.name }</option>;
      });
    }

    let periodicityOptions = '';
    if(this.props.periodicities.length) {
      periodicityOptions = this.props.periodicities.map((per, index) => {
          return <option key={ index } value={ per.id }>{ per.name }</option>;
      });
    }

    let mediaTypesOptions = '';
    if(this.props.mediaTypes.length) {
      mediaTypesOptions = this.props.mediaTypes.map((media, index) => {
          return <option key={ index } value={ media.id }>{ media.name }</option>;
      });
    }

    let provincesOptions = '';
    if(this.props.provinces.length) {
        provincesOptions = this.props.provinces.map((prov, index) => {
            return <option key={ index } value={ prov.id }>{ prov.name }</option>;
        });
    }

    let journalistOptions = '';
    if(this.props.allJournalists.length) {
      journalistOptions = this.props.allJournalists.map((j, index) => {
          return <option key={ index } value={ j.id }>{ j.name } { j.surname } - { j.email }</option>;
      });
    }

    return (

        <Form horizontal className="well" id="journalists-filters">
          <Row>
            <Col xs={6}>
              <fieldset>
                <legend>Filtri</legend>

                <FormGroup
                  controlId="ranking"
                >
                  <Col componentClass={ControlLabel} sm={2}>
                    Ranking
                  </Col>
                  <Col sm={10}>
                    <FormControl
                      type="number"
                      value={this.props.filters.ranking.value}
                      placeholder="0-10"
                      onChange={this.handleRankingChange.bind(this)}
                    />
                  <HelpBlock>Inserisci il valore massimo per cui filtrare il ranking</HelpBlock>
                  </Col>
                </FormGroup>

                <FormGroup
                  controlId="categories"
                >
                  <Col componentClass={ControlLabel} sm={2}>
                    Categorie
                  </Col>
                  <Col sm={10}>
                    <FormControl componentClass="select" className='chosen-select' multiple data-placeholder="Ricerca le categorie">
                      { categoryOptions }
                    </FormControl>
                    <HelpBlock>Seleziona una o pi&ugrave; categorie</HelpBlock>
                  </Col>
                </FormGroup>

                <FormGroup
                  controlId="periodicities"
                >
                  <Col componentClass={ControlLabel} sm={2}>
                    Periodicità
                  </Col>
                  <Col sm={10}>
                    <FormControl componentClass="select" className='chosen-select' multiple data-placeholder="Seleziona le periodicità">
                      { periodicityOptions }
                    </FormControl>
                    <HelpBlock>Seleziona uno o pi&ugrave; tipi di periodicità delle testate con i giornalisti collaborano</HelpBlock>
                  </Col>
                </FormGroup>

                <FormGroup
                  controlId="media-types"
                >
                  <Col componentClass={ControlLabel} sm={2}>
                    Tipi di media
                  </Col>
                  <Col sm={10}>
                    <FormControl componentClass="select" className='chosen-select' multiple data-placeholder="Seleziona i tipi di media">
                      { mediaTypesOptions }
                    </FormControl>
                    <HelpBlock>Seleziona uno o pi&ugrave; tipi di media delle testate con cui i giornalisti collaborano</HelpBlock>
                  </Col>
                </FormGroup>
              </fieldset>

            </Col>
            <Col xs={6}>

              <fieldset>
                  <legend>Tiratura</legend>

                  <FormGroup
                    controlId="national-circulation"
                  >
                    <Col smOffset={2} sm={10}>
                      <Checkbox
                        onChange={this.handleNationalCirculationChange.bind(this)}
                      >
                        Solo nazionale
                      </Checkbox>
                    </Col>
                  </FormGroup>

                  <FormGroup
                    controlId="provinces"
                  >
                    <Col componentClass={ControlLabel} sm={2}>
                      Città
                    </Col>
                    <Col sm={10}>
                      <FormControl componentClass="select" className='chosen-select' multiple data-placeholder="Seleziona le città">
                        { provincesOptions }
                      </FormControl>
                      <HelpBlock>Seleziona uno o pi&ugrave; città delle testate con cui i giornalisti collaborano</HelpBlock>
                    </Col>
                  </FormGroup>

              </fieldset>

              <fieldset>
                  <legend>Escludi ed includi email</legend>

                  <FormGroup
                    controlId="black-list"
                  >
                    <Col componentClass={ControlLabel} sm={2}>
                      Escludi
                    </Col>
                    <Col sm={10}>
                      <FormControl componentClass="select" className='chosen-select' multiple data-placeholder="Ricerca i giornalisti da escludere">
                        { journalistOptions }
                      </FormControl>
                      <HelpBlock>Escludi uno o più giornalisti anche se rispondono ai parametri ricercati</HelpBlock>
                    </Col>
                  </FormGroup>

                  <FormGroup
                    controlId="white-list"
                  >
                    <Col componentClass={ControlLabel} sm={2}>
                      Aggiungi
                    </Col>
                    <Col sm={10}>
                      <FormControl componentClass="select" className='chosen-select' multiple data-placeholder="Ricerca i giornalisti da aggiungere">
                        { journalistOptions }
                      </FormControl>
                      <HelpBlock>Aggiungi uno o più giornalisti ignorando i filtri precedenti</HelpBlock>
                    </Col>
                  </FormGroup>

                </fieldset>
              <FormGroup>
                <Col xsOffset={2} sm={10}>
                    <Button bsStyle="primary" className="pull-right btn-block" onClick={this.handleFilterSubmit.bind(this)}>Filtra</Button>
                </Col>
              </FormGroup>
            </Col>
          </Row>
        </Form>

      );
  }

};

export default JournalistFilter;
