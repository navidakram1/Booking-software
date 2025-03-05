-- Insert sample categories
INSERT INTO categories (name, description, created_at, updated_at) VALUES
('Hair Care', 'All hair related services including cutting, styling, and coloring', NOW(), NOW()),
('Nail Care', 'Manicure, pedicure, and nail art services', NOW(), NOW()),
('Facial', 'Facial treatments and skincare services', NOW(), NOW()),
('Massage', 'Various types of massage therapies', NOW(), NOW());

-- Insert sample services
INSERT INTO services (category_id, name, description, duration, price, is_active, created_at, updated_at) VALUES
(1, 'Haircut', 'Professional haircut and styling', 45, 50.00, 1, NOW(), NOW()),
(1, 'Hair Coloring', 'Full hair coloring service', 120, 150.00, 1, NOW(), NOW()),
(2, 'Manicure', 'Basic manicure service', 30, 35.00, 1, NOW(), NOW()),
(2, 'Pedicure', 'Basic pedicure service', 45, 45.00, 1, NOW(), NOW()),
(3, 'Basic Facial', 'Deep cleansing facial', 60, 75.00, 1, NOW(), NOW()),
(4, 'Swedish Massage', 'Full body relaxation massage', 60, 90.00, 1, NOW(), NOW());

-- Insert sample specialists
INSERT INTO specialists (name, email, phone, bio, years_of_experience, is_active, created_at, updated_at) VALUES
('Sarah Johnson', 'sarah.j@glamgo.com', '555-0101', 'Expert hair stylist with over 5 years of experience', 5, 1, NOW(), NOW()),
('Michael Chen', 'michael.c@glamgo.com', '555-0102', 'Certified massage therapist', 3, 1, NOW(), NOW()),
('Emma Wilson', 'emma.w@glamgo.com', '555-0103', 'Nail care specialist', 4, 1, NOW(), NOW());

-- Create Service Specialist Bridge Table (with Laravel's naming convention)
CREATE TABLE service_specialist (
    service_id BIGINT UNSIGNED,
    specialist_id BIGINT UNSIGNED,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    PRIMARY KEY (service_id, specialist_id),
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE,
    FOREIGN KEY (specialist_id) REFERENCES specialists(id) ON DELETE CASCADE
);

-- Insert sample service-specialist relationships
INSERT INTO service_specialist (service_id, specialist_id, created_at, updated_at) VALUES
-- Sarah Johnson (id: 1) - Hair services
(1, 1, NOW(), NOW()), -- Haircut
(2, 1, NOW(), NOW()), -- Hair Coloring

-- Michael Chen (id: 2) - Massage services
(6, 2, NOW(), NOW()), -- Swedish Massage

-- Emma Wilson (id: 3) - Nail services
(3, 3, NOW(), NOW()), -- Manicure
(4, 3, NOW(), NOW()); -- Pedicure

-- Add is_active column to categories table
ALTER TABLE categories
ADD COLUMN is_active BOOLEAN DEFAULT TRUE AFTER image_url;

-- Update all existing categories to be active
UPDATE categories SET is_active = 1;
