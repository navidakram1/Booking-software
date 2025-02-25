-- Insert Categories
INSERT INTO categories (name, slug, description, icon) VALUES
('Hair Care', 'hair-care', 'All hair related services including cutting, styling, and coloring', 'scissors'),
('Nail Care', 'nail-care', 'Manicure, pedicure, and nail art services', 'hand'),
('Facial', 'facial', 'Facial treatments and skincare services', 'face'),
('Massage', 'massage', 'Various types of massage therapies', 'massage');

-- Insert Services
INSERT INTO services (category_id, name, slug, description, price, duration, is_active) VALUES
(1, 'Haircut', 'haircut', 'Professional haircut and styling', 50.00, 45, TRUE),
(1, 'Hair Coloring', 'hair-coloring', 'Full hair coloring service', 150.00, 120, TRUE),
(2, 'Manicure', 'manicure', 'Basic manicure service', 35.00, 30, TRUE),
(2, 'Pedicure', 'pedicure', 'Basic pedicure service', 45.00, 45, TRUE),
(3, 'Basic Facial', 'basic-facial', 'Deep cleansing facial', 75.00, 60, TRUE),
(4, 'Swedish Massage', 'swedish-massage', 'Full body relaxation massage', 90.00, 60, TRUE);

-- Insert Staff with Working Hours
INSERT INTO staff (name, email, phone, specialization, working_hours, is_active) VALUES
('Sarah Johnson', 'sarah.j@glamgo.com', '555-0101', 'Hair Stylist', 
 '{"monday": {"start": "09:00", "end": "17:00"}, 
   "tuesday": {"start": "09:00", "end": "17:00"}, 
   "wednesday": {"start": "09:00", "end": "17:00"}, 
   "thursday": {"start": "09:00", "end": "17:00"}, 
   "friday": {"start": "09:00", "end": "17:00"}}', TRUE),
('Michael Chen', 'michael.c@glamgo.com', '555-0102', 'Massage Therapist',
 '{"monday": {"start": "10:00", "end": "18:00"}, 
   "tuesday": {"start": "10:00", "end": "18:00"}, 
   "wednesday": {"start": "10:00", "end": "18:00"}, 
   "thursday": {"start": "10:00", "end": "18:00"}, 
   "friday": {"start": "10:00", "end": "18:00"}}', TRUE),
('Emma Wilson', 'emma.w@glamgo.com', '555-0103', 'Nail Technician',
 '{"monday": {"start": "09:00", "end": "17:00"}, 
   "tuesday": {"start": "09:00", "end": "17:00"}, 
   "wednesday": {"start": "09:00", "end": "17:00"}, 
   "thursday": {"start": "09:00", "end": "17:00"}, 
   "friday": {"start": "09:00", "end": "17:00"}}', TRUE);

-- Link Staff to Services
INSERT INTO service_staff (service_id, staff_id) VALUES
(1, 1), -- Sarah - Haircut
(2, 1), -- Sarah - Hair Coloring
(3, 3), -- Emma - Manicure
(4, 3), -- Emma - Pedicure
(6, 2); -- Michael - Swedish Massage

-- Insert Service Packages
INSERT INTO service_packages (name, description, price, duration, is_active) VALUES
('Deluxe Spa Package', 'Complete spa treatment including facial and massage', 150.00, 120, TRUE),
('Nail Care Package', 'Complete manicure and pedicure treatment', 70.00, 75, TRUE);

-- Link Services to Packages
INSERT INTO package_services (package_id, service_id, quantity) VALUES
(1, 5, 1), -- Deluxe Spa Package - Basic Facial
(1, 6, 1), -- Deluxe Spa Package - Swedish Massage
(2, 3, 1), -- Nail Care Package - Manicure
(2, 4, 1); -- Nail Care Package - Pedicure

-- Insert Service Addons
INSERT INTO service_addons (service_id, name, description, price, duration, is_active) VALUES
(1, 'Hair Treatment', 'Deep conditioning treatment', 25.00, 15, TRUE),
(2, 'Highlights', 'Partial highlights', 50.00, 30, TRUE),
(3, 'Nail Art', 'Basic nail art design', 15.00, 15, TRUE),
(5, 'Face Mask', 'Premium face mask treatment', 20.00, 15, TRUE);

-- Insert Settings
INSERT INTO settings (setting_key, setting_value) VALUES
('business_name', 'GlamGo Beauty Salon'),
('business_address', '123 Beauty Street, Fashion District'),
('business_phone', '555-0100'),
('business_email', 'info@glamgo.com'),
('appointment_interval', '15'),
('max_advance_booking_days', '30');
