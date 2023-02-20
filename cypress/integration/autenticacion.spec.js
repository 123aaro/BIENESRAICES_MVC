/// <reference types="cypress" />

describe('Probar la autenticación', () => {
    it('Prueba la autenticación en /login', () => {
        cy.visit('/login');

        cy.get('[data-cy="heading-login"]').should('exist');
        cy.get('[data-cy="heading-login"]').should('have.text', 'Iniciar sesión');
        
        cy.get('[data-cy="formulario-login"]').should('exist');

        // Ambos campos son obligatorios
        cy.get('[data-cy="formulario-login"]').submit();
        cy.get('[data-cy="alerta-login"]').should('exist');
        cy.get('[data-cy="alerta-login"]').eq(0).should('have.class', 'error');
        cy.get('[data-cy="alerta-login"]').eq(0).should('have.text', 'EL email es obligatorio');
        
        cy.get('[data-cy="alerta-login"]').eq(1).should('have.class', 'error');
        cy.get('[data-cy="alerta-login"]').eq(1).should('have.text', 'EL password es obligatorio');
        
        // El usuario exista

        // Verificar el password
    })
})