/// <reference types="cypress" />

describe('Prueba el Formulario de Contacto', () => {
    it('Prueba la página de contacto y el envio de emails,', () => {
        cy.visit('/contacto');

        cy.get('[data-cy="heading-contacto"]').should('exist');
        cy.get('[data-cy="heading-contacto"]').invoke('text').should('equal', 'Contacto');
        cy.get('[data-cy="heading-contacto"]').invoke('text').should('not.equal', 'Formulario de contacto');

        cy.get('[data-cy="heading-formulario"]').should('exist');
        cy.get('[data-cy="heading-formulario"]').invoke('text').should('equal', 'Llene el formulario de Contacto');
        cy.get('[data-cy="heading-formulario"]').invoke('text').should('not.equal', 'Llene el formulario');
        
        cy.get('[data-cy="formulario-contacto"]').should('exist');

    });

    it('Llena los campos del formulario', () =>{
        cy.get('[data-cy="input-nombre"]').type('Aaron');
        cy.get('[data-cy="input-mensaje"]').type('Me gustaría adquirir una vivienda con ustedes');
        cy.get('[data-cy="input-opciones"]').select('Vende');
        cy.get('[data-cy="input-precio"]').type('120000');
        cy.get('[data-cy="forma-contacto"]').eq(1).check();
        
        cy.wait(3000);
        cy.get('[data-cy="forma-contacto"]').eq(0).check();
        cy.get('[data-cy="input-telefono"]').type('123456789');
        cy.get('[data-cy="input-fecha"]').type('2022-04-25');
        cy.get('[data-cy="input-hora"]').type('12:22');
        
        cy.get('[data-cy="formulario-contacto"]').submit();
        
        cy.get('[data-cy="alerta-envio-formulario"]').should('exist');
        cy.get('[data-cy="alerta-envio-formulario"]').invoke('text').should('equal', 'Email Enviado Correctamente');
        cy.get('[data-cy="alerta-envio-formulario"]').should('have.class', 'alerta').and('have.class', 'exito').and('not.have.class', 'error');
    });

});