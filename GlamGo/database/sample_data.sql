-- Insert sample categories
INSERT INTO categories (name, description, slug) VALUES
('Hair Care', 'All hair related services including cutting, styling, and coloring', 'hair-care');
SET @hair_care_id = LAST_INSERT_ID();

INSERT INTO categories (name, description, slug) VALUES
('Nail Care', 'Manicure, pedicure, and nail art services', 'nail-care');
SET @nail_care_id = LAST_INSERT_ID();

INSERT INTO categories (name, description, slug) VALUES
('Facial', 'Facial treatments and skincare services', 'facial');
SET @facial_id = LAST_INSERT_ID();

INSERT INTO categories (name, description, slug) VALUES
('Massage', 'Various types of massage therapies', 'massage');
SET @massage_id = LAST_INSERT_ID();

-- Insert sample services
INSERT INTO services (category_id, name, description, duration, price, slug) VALUES
(@hair_care_id, 'Haircut', 'Professional haircut and styling', 45, 50.00, 'haircut'),
(@hair_care_id, 'Hair Coloring', 'Full hair coloring service', 120, 150.00, 'hair-coloring'),
(@nail_care_id, 'Manicure', 'Basic manicure service', 30, 35.00, 'manicure'),
(@nail_care_id, 'Pedicure', 'Basic pedicure service', 45, 45.00, 'pedicure'),
(@facial_id, 'Basic Facial', 'Deep cleansing facial', 60, 75.00, 'basic-facial'),
(@massage_id, 'Swedish Massage', 'Full body relaxation massage', 60, 90.00, 'swedish-massage');

-- Insert sample staff
INSERT INTO staff (name, email, phone) VALUES
('Sarah Johnson', 'sarah.j@glamgo.com', '555-0101');
SET @sarah_id = LAST_INSERT_ID();

INSERT INTO staff (name, email, phone) VALUES
('Michael Chen', 'michael.c@glamgo.com', '555-0102');
SET @michael_id = LAST_INSERT_ID();

INSERT INTO staff (name, email, phone) VALUES
('Emma Wilson', 'emma.w@glamgo.com', '555-0103');
SET @emma_id = LAST_INSERT_ID();

-- Get service IDs
SET @haircut_id = (SELECT id FROM services WHERE slug = 'haircut');
SET @hair_coloring_id = (SELECT id FROM services WHERE slug = 'hair-coloring');
SET @manicure_id = (SELECT id FROM services WHERE slug = 'manicure');
SET @pedicure_id = (SELECT id FROM services WHERE slug = 'pedicure');
SET @facial_id = (SELECT id FROM services WHERE slug = 'basic-facial');
SET @massage_id = (SELECT id FROM services WHERE slug = 'swedish-massage');

-- Link staff to services
INSERT INTO service_staff (staff_id, service_id) VALUES
(@sarah_id, @haircut_id),
(@sarah_id, @hair_coloring_id),
(@michael_id, @massage_id),
(@emma_id, @manicure_id),
(@emma_id, @pedicure_id);
