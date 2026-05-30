-- FLIRM SOLICITORS Database Schema
-- Run this in phpMyAdmin or MySQL CLI

CREATE DATABASE IF NOT EXISTS flirm_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE flirm_db;

-- Admin Users
CREATE TABLE admin_users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Site Settings
CREATE TABLE site_settings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    site_name VARCHAR(255) NOT NULL DEFAULT 'FLIRM SOLICITORS',
    site_tagline VARCHAR(255) DEFAULT 'Professional Legal Services Rooted in Integrity, Excellence & Results',
    site_description TEXT,
    logo_url VARCHAR(255) DEFAULT 'assets/images/logo.png',
    favicon_url VARCHAR(255) DEFAULT 'assets/images/favicon.ico',
    footer_text TEXT,
    copyright_text VARCHAR(255) DEFAULT '© 2026 FLIRM SOLICITORS. All Rights Reserved.',
    smtp_host VARCHAR(255) DEFAULT NULL,
    smtp_port VARCHAR(10) DEFAULT NULL,
    smtp_username VARCHAR(255) DEFAULT NULL,
    smtp_password VARCHAR(255) DEFAULT NULL,
    smtp_from_email VARCHAR(255) DEFAULT NULL,
    smtp_from_name VARCHAR(255) DEFAULT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Hero Section
CREATE TABLE hero_section (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL DEFAULT 'FLIRM SOLICITORS',
    subtitle VARCHAR(255) DEFAULT 'Professional Legal Services Rooted in Integrity, Excellence & Results',
    description TEXT,
    managing_partner_name VARCHAR(255) DEFAULT 'Managing Partner: Onyemaechi Harris Basil',
    address VARCHAR(255) DEFAULT 'No. 12 Oduyemi Street, Anifowoshe, Ikeja, Lagos',
    email VARCHAR(100) DEFAULT 'info@flirm.com.ng',
    phone VARCHAR(50) DEFAULT '08037059291',
    btn1_text VARCHAR(50) DEFAULT 'Book Consultation',
    btn1_link VARCHAR(255) DEFAULT '#contact',
    btn2_text VARCHAR(50) DEFAULT 'Contact Us',
    btn2_link VARCHAR(255) DEFAULT '#contact',
    btn3_text VARCHAR(50) DEFAULT 'Learn More',
    btn3_link VARCHAR(255) DEFAULT '#about',
    background_image VARCHAR(255),
    background_overlay VARCHAR(7) DEFAULT '#000000',
    is_active TINYINT(1) DEFAULT 1,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- About Section
CREATE TABLE about_section (
    id INT PRIMARY KEY AUTO_INCREMENT,
    heading VARCHAR(255) NOT NULL DEFAULT 'Who We Are',
    content TEXT NOT NULL,
    image_url VARCHAR(255),
    is_active TINYINT(1) DEFAULT 1,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Managing Partner
CREATE TABLE managing_partner (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL DEFAULT 'Onyemaechi Harris Basil',
    title VARCHAR(255) DEFAULT 'Managing Partner',
    bio TEXT NOT NULL,
    image_url VARCHAR(255),
    is_active TINYINT(1) DEFAULT 1,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Practice Areas
CREATE TABLE practice_areas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    short_description TEXT,
    services TEXT,
    icon_class VARCHAR(100) DEFAULT 'fa-gavel',
    display_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Why Choose Us
CREATE TABLE why_choose_us (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    icon_class VARCHAR(100) DEFAULT 'fa-star',
    display_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Mission & Vision
CREATE TABLE mission_vision (
    id INT PRIMARY KEY AUTO_INCREMENT,
    type ENUM('mission', 'vision') NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Contact Info
CREATE TABLE contact_info (
    id INT PRIMARY KEY AUTO_INCREMENT,
    address VARCHAR(255) DEFAULT 'No. 12 Oduyemi Street, Anifowoshe, Ikeja, Lagos',
    email VARCHAR(100) DEFAULT 'info@flirm.com.ng',
    phone VARCHAR(50) DEFAULT '08037059291',
    office_hours_weekdays VARCHAR(255) DEFAULT 'Monday – Friday: 8:00 AM – 5:00 PM',
    office_hours_saturday VARCHAR(255) DEFAULT 'Saturday: By Appointment',
    office_hours_sunday VARCHAR(255) DEFAULT 'Sunday: Closed',
    map_embed TEXT,
    is_active TINYINT(1) DEFAULT 1,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Social Media
CREATE TABLE social_media (
    id INT PRIMARY KEY AUTO_INCREMENT,
    platform VARCHAR(50) NOT NULL,
    url VARCHAR(255) NOT NULL,
    icon_class VARCHAR(100),
    display_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Consulting Section
CREATE TABLE consulting_section (
    id INT PRIMARY KEY AUTO_INCREMENT,
    company_name VARCHAR(255) NOT NULL DEFAULT 'FLIRM CONSULTING SERVICES LTD',
    tagline VARCHAR(255),
    content TEXT NOT NULL,
    image_url VARCHAR(255),
    is_active TINYINT(1) DEFAULT 1,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Footer Content
CREATE TABLE footer_content (
    id INT PRIMARY KEY AUTO_INCREMENT,
    about_text TEXT,
    address VARCHAR(255) DEFAULT 'Ikeja, Lagos, Nigeria',
    email VARCHAR(100) DEFAULT 'info@flirm.com.ng',
    phone VARCHAR(50) DEFAULT '08037059291',
    copyright_text VARCHAR(255) DEFAULT '© 2026 FLIRM SOLICITORS. All Rights Reserved.',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Page Content (NDPR, Privacy Policy, Whistleblowing, etc.)
CREATE TABLE page_content (
    id INT PRIMARY KEY AUTO_INCREMENT,
    page_key VARCHAR(100) NOT NULL UNIQUE,
    title VARCHAR(255) NOT NULL,
    content TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Attorneys
CREATE TABLE attorneys (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    short_bio TEXT,
    bio TEXT,
    image_url VARCHAR(255),
    display_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Contact Messages
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(50),
    subject VARCHAR(255),
    message TEXT NOT NULL,
    is_read TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert Default Admin User (password: admin123 - CHANGE AFTER LOGIN)
INSERT INTO admin_users (username, password, email) VALUES
('flirm', '$2y$10$7oDSzf2bHYYdeSLNdB4DvOra/wdP.JwVVhzyzy5ZGu0q5IZraeQXe', 'admin@flirm.com.ng');

-- Insert Default Data
INSERT INTO site_settings (id, site_name, site_tagline, footer_text, copyright_text, smtp_host, smtp_port, smtp_username, smtp_password, smtp_from_email, smtp_from_name) VALUES
(1, 'FLIRM SOLICITORS', 'Professional Legal Services Rooted in Integrity, Excellence & Results', 'Professional Legal Services You Can Trust.', '© 2026 FLIRM SOLICITORS. All Rights Reserved.', 'mail.flirm.com.ng', '465', 'info@flirm.com.ng', 'Francisca2009', 'info@flirm.com.ng', 'FLIRM SOLICITORS');

INSERT INTO hero_section (id, title, subtitle, description, managing_partner_name, address, email, phone) VALUES
(1, 'FLIRM SOLICITORS', 'Professional Legal Services Rooted in Integrity, Excellence & Results', 'At FLIRM SOLICITORS, we provide strategic legal solutions tailored to individuals, businesses, investors, and organizations. Our commitment is to deliver professional, reliable, and result-oriented legal representation with the highest ethical standards.', 'Managing Partner: Onyemaechi Harris Basil', 'No. 12 Oduyemi Street, Anifowoshe, Ikeja, Lagos', 'info@flirm.com.ng', '08037059291');

INSERT INTO about_section (id, heading, content) VALUES
(1, 'Who We Are', 'FLIRM SOLICITORS is a dynamic and client-focused law firm based in Ikeja, Lagos, Nigeria. We are dedicated to providing sound legal advisory, litigation support, corporate legal services, and dispute resolution solutions for clients across diverse sectors. Our firm combines professionalism, strategic thinking, and deep legal expertise to protect our clients'' interests while delivering practical legal solutions. We pride ourselves on integrity, confidentiality, diligence, and excellence in legal practice.');

INSERT INTO managing_partner (id, name, title, bio) VALUES
(1, 'Onyemaechi Harris Basil', 'Managing Partner', 'Onyemaechi Harris Basil is an accomplished legal practitioner with extensive experience in corporate legal advisory, litigation, real estate transactions, regulatory compliance, and dispute resolution. As the Managing Partner of FLIRM SOLICITORS, he is committed to delivering exceptional legal services while upholding justice, professionalism, and client satisfaction. His leadership continues to position the firm as a trusted legal partner for individuals, businesses, and investors.');

INSERT INTO practice_areas (title, short_description, services, icon_class, display_order) VALUES
('Corporate & Commercial Law', 'We provide legal support for businesses, startups, and corporate organizations.', 'Company registration|Corporate governance|Contract drafting and review|Regulatory compliance|Business advisory services', 'fa-briefcase', 1),
('Real Estate & Property Law', 'Our firm offers legal guidance in property and real estate matters.', 'Property verification|Land documentation|Title perfection|Real estate transactions|Property dispute resolution', 'fa-building', 2),
('Litigation & Dispute Resolution', 'We represent clients in litigation and dispute resolution.', 'Civil litigation|Commercial disputes|Debt recovery|Mediation and arbitration|Legal defense and representation', 'fa-gavel', 3),
('Intellectual Property & Trademark', 'Protecting your brand and intellectual assets.', 'Trademark registration|Copyright protection|Intellectual property advisory|Brand protection services', 'fa-copyright', 4),
('Family & Probate Law', 'We assist clients in family and probate matters.', 'Divorce proceedings|Child custody matters|Estate administration|Wills and probate services', 'fa-users', 5);

INSERT INTO why_choose_us (title, description, icon_class, display_order) VALUES
('Professional Excellence', 'We maintain high standards of professionalism and legal ethics.', 'fa-shield-alt', 1),
('Client-Focused Approach', 'Every client receives personalized legal attention and strategic solutions.', 'fa-handshake', 2),
('Integrity & Confidentiality', 'We protect our clients'' interests with utmost confidentiality and honesty.', 'fa-lock', 3),
('Result-Oriented Representation', 'We pursue practical and effective legal outcomes for our clients.', 'fa-chart-line', 4),
('Trusted Legal Advisory', 'Our legal expertise helps clients make informed decisions confidently.', 'fa-balance-scale', 5);

INSERT INTO mission_vision (type, title, content) VALUES
('mission', 'Our Mission', 'To provide exceptional legal services through integrity, professionalism, innovation, and client-centered representation.'),
('vision', 'Our Vision', 'To become one of Nigeria''s most trusted and respected law firms known for excellence, justice, and professional integrity.');

INSERT INTO contact_info (id, address, email, phone, office_hours_weekdays, office_hours_saturday, office_hours_sunday) VALUES
(1, 'No. 12 Oduyemi Street, Anifowoshe, Ikeja, Lagos', 'info@flirm.com.ng', '08037059291', 'Monday – Friday: 8:00 AM – 5:00 PM', 'Saturday: By Appointment', 'Sunday: Closed');

INSERT INTO consulting_section (id, company_name, tagline, content) VALUES
(1, 'FLIRM CONSULTING SERVICES LTD', 'Your Trusted Partner in Legal Advisory & Business Support', 'FLIRM CONSULTING SERVICES LTD is a professional consulting and support services company committed to delivering reliable, efficient, and result-driven solutions to individuals, businesses, organizations, and property investors across Nigeria. The company specializes in providing expert legal advisory services in land and property acquisition, helping clients navigate documentation, verification, compliance, and secure real estate transactions with confidence and transparency. Beyond legal and property advisory, FLIRM CONSULTING SERVICES LTD offers comprehensive event management services, property management solutions, administrative support, staff recruitment services, as well as project management advisory and execution tailored to meet the evolving needs of modern businesses and institutions. Driven by professionalism, integrity, excellence, and client satisfaction, the company is dedicated to delivering strategic solutions that enhance operational efficiency, reduce risks, and promote sustainable growth for its clients. With a commitment to quality service delivery and innovative problem-solving, FLIRM CONSULTING SERVICES LTD continues to position itself as a trusted consulting partner for corporate organizations, entrepreneurs, property owners, and investors.');

INSERT INTO footer_content (id, about_text, address, email, phone, copyright_text) VALUES
(1, 'Professional Legal Services You Can Trust.', 'Ikeja, Lagos, Nigeria', 'info@flirm.com.ng', '08037059291', '© 2026 FLIRM SOLICITORS. All Rights Reserved.');

INSERT INTO page_content (page_key, title, content) VALUES
('ndpr-compliance', 'NDPR Compliance', '<h2>Our Commitment to Data Protection</h2><p>FLIRM SOLICITORS is committed to protecting the privacy and personal data of our clients, employees, and stakeholders in full compliance with the Nigeria Data Protection Regulation (NDPR).</p><h3>Data Protection Principles</h3><p>We adhere to the following principles: (1) Lawful, fair, and transparent processing; (2) Purpose limitation; (3) Data minimization; (4) Accuracy; (5) Storage limitation; (6) Integrity and confidentiality; (7) Accountability.</p><h3>Your Rights Under NDPR</h3><p>As a data subject, you have the right to: request access to your personal data; request correction of inaccurate data; request deletion of your data; restrict processing; data portability; object to processing; and withdraw consent at any time.</p><h3>Data Protection Officer</h3><p>Our Data Protection Officer oversees compliance with NDPR requirements. For inquiries, contact our DPO at info@flirm.com.ng.</p>'),
('privacy-policy', 'Privacy Policy', '<h2>Introduction</h2><p>FLIRM SOLICITORS respects your privacy and is committed to protecting your personal data. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or use our services.</p><h3>Information We Collect</h3><p>We may collect personal identification information (name, email address, phone number) and usage data (browser type, pages visited, time spent).</p><h3>How We Use Your Information</h3><p>We use collected data to provide legal services, respond to inquiries, improve our website, send relevant communications, and comply with legal obligations.</p><h3>Data Retention</h3><p>We retain personal data only as long as necessary for the purposes outlined in this policy, or as required by law.</p><h3>Third-Party Disclosure</h3><p>We do not sell, trade, or transfer your personal information to third parties without your consent, except as required by law.</p><h3>Contact</h3><p>For questions about this Privacy Policy, contact us at info@flirm.com.ng.</p>'),
('whistleblowing', 'Whistleblowing Policy', '<h2>Whistleblowing Policy</h2><p>FLIRM SOLICITORS is committed to the highest standards of integrity, transparency, and accountability. Our Whistleblowing Policy provides a framework for individuals to raise genuine concerns about misconduct or malpractice.</p><h3>What to Report</h3><p>Concerns may include: financial irregularities, fraud, corruption, unethical conduct, breach of legal obligations, health and safety violations, environmental damage, or any other serious wrongdoing.</p><h3>How to Report</h3><p>Reports can be made in confidence via email to info@flirm.com.ng or through our dedicated reporting channel. Anonymous reports are accepted and will be investigated thoroughly.</p><h3>Protection for Whistleblowers</h3><p>FLIRM SOLICITORS will not tolerate any form of retaliation against individuals who raise genuine concerns in good faith. All reports will be treated confidentially and investigated impartially.</p><h3>Reporting Channel</h3><p>For whistleblowing reports, contact: info@flirm.com.ng.</p>');

INSERT INTO attorneys (name, title, short_bio, bio, display_order) VALUES
('Chidi Okonkwo', 'Senior Associate', 'A seasoned litigator with over a decade of experience in civil and commercial litigation, dispute resolution, and arbitration.', 'Chidi Okonkwo is a Senior Associate at FLIRM SOLICITORS with extensive experience in civil litigation, commercial dispute resolution, and arbitration. He has represented clients across various industries including banking, insurance, and telecommunications. Chidi holds an LL.M from the University of Lagos and is a member of the Nigerian Bar Association and the Chartered Institute of Arbitrators (UK). He is known for his meticulous preparation and persuasive advocacy.', 1),
('Amara Nwachukwu', 'Associate, Intellectual Property', 'Specializing in intellectual property law, technology transactions, and data protection compliance.', 'Amara Nwachukwu is an Associate specializing in Intellectual Property and Technology Law. She advises clients on patent filings, trademark registration, copyright protection, and technology licensing agreements. Amara is also a certified data protection officer and assists clients with NDPR compliance. She holds a first-class degree from the University of Ibadan and is a regular speaker at IP law conferences.', 2),
('Emeka Okafor', 'Associate, Real Estate & Property', 'Practicing in real estate transactions, property law, land documentation, and due diligence.', 'Emeka Okafor is an Associate in the Real Estate and Property Practice Group. He handles property acquisitions, title searches, land documentation, lease agreements, and real estate due diligence for corporate and individual clients. Emeka''s deep understanding of land law across multiple Nigerian states makes him a valuable asset for clients navigating complex property transactions. He is admitted to the Nigerian Bar and holds an LL.B from the University of Benin.', 3),
('Yetunde Bamidele', 'Associate, Family Law', 'Focused on family law, matrimonial causes, child welfare, and alternative dispute resolution.', 'Yetunde Bamidele is an Associate practicing in Family Law and Alternative Dispute Resolution. She handles matrimonial causes, child custody arrangements, adoption proceedings, and mediation services. Yetunde is passionate about protecting the rights of children and vulnerable individuals. She is a trained mediator and member of the International Bar Association. She holds an LL.M in Human Rights Law from the University of Lagos.', 4);

INSERT INTO social_media (platform, url, icon_class, display_order) VALUES
('Facebook', '#', 'fa-facebook-f', 1),
('Instagram', '#', 'fa-instagram', 2),
('LinkedIn', '#', 'fa-linkedin-in', 3),
('X (Twitter)', '#', 'fa-x-twitter', 4);
