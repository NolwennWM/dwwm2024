INSERT INTO messages (content, UserId) 
VALUES 
('Bonjour', (SELECT id FROM users WHERE username = "Cécilius")), 
('mange du pain', (SELECT id FROM users WHERE username = "Cécilius")), 
('Pizza time', (SELECT id FROM users WHERE username = "Cécilius")), 
('salade niçoise ou rien', (SELECT id FROM users WHERE username = "Cécilius")), 
('Vive les regex', (SELECT id FROM users WHERE username = "Elzemond")), 
('JS logic', (SELECT id FROM users WHERE username = "Elzemond")), 
('Coucou', (SELECT id FROM users WHERE username = "Elzemond")), 
('Bonsoir', (SELECT id FROM users WHERE username = "Hypolite")), 
('Je fais la loi !', (SELECT id FROM users WHERE username = "Hypolite")), 
('Ne regarde pas derrière toi.', (SELECT id FROM users WHERE username = "Hypolite")), 
('Connaissez vous les trois coquillages?', (SELECT id FROM users WHERE username = "Hypolite")), 
('42', (SELECT id FROM users WHERE username = "Hypolite")), 
('salut', (SELECT id FROM users WHERE username = "Florestan")), 
('mangez 5 fruits et légumes par jour', (SELECT id FROM users WHERE username = "Florestan")); 