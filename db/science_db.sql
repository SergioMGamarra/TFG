-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:8889
-- Tiempo de generación: 12-09-2016 a las 00:23:50
-- Versión del servidor: 5.5.42
-- Versión de PHP: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `science_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Articulo`
--

CREATE TABLE `Articulo` (
  `id` int(11) NOT NULL,
  `usuario` int(11) DEFAULT NULL,
  `titulo` varchar(255) NOT NULL,
  `abstract` text NOT NULL,
  `contenido` longtext,
  `fecha` varchar(46) DEFAULT NULL,
  `rev_publicado` varchar(120) NOT NULL,
  `fecha_insert` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `autor` varchar(255) NOT NULL,
  `enlace` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=859 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Articulo`
--

INSERT INTO `Articulo` (`id`, `usuario`, `titulo`, `abstract`, `contenido`, `fecha`, `rev_publicado`, `fecha_insert`, `autor`, `enlace`) VALUES
(808, 0, 'Choosing the right NoSQL database for the job: a quality attribute evaluation', 'For over forty years, relational databases have been the leading model for data storage, retrieval and management. However, due to increasing needs for scalability and performance, alternative systems have eme...', '', '14 August 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'João Ricardo Lourenço, Bruno Cabral, Paulo Carreiro, Marco Vieira and Jorge Bernardino', 'files/0/2016/09/11/Choosing_the_right_NoSQL_database_for_the_job:_a_quality_attribute_evaluation.pdf'),
(809, 0, 'A novel algorithm for fast and scalable subspace clustering of high-dimensional data', 'Rapid growth of high dimensional datasets in recent years has created an emergent need to extract the knowledge underlying them. Clustering is the process of automatically finding groups of similar data points...', '', '12 August 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'Amardeep Kaur and Amitava Datta', 'files/0/2016/09/11/A_novel_algorithm_for_fast_and_scalable_subspace_clustering_of_high-dimensional_data.pdf'),
(810, 0, 'Database application model and its service for drug discovery in Model-driven architecture', 'Big data application has many data resources and data. In the first stage of software engineering, a service overview or a system overview cannot be seen. In this paper, we propose that two processes of “Big d...', '', '7 August 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'Noriko Etani', 'files/0/2016/09/11/Database_application_model_and_its_service_for_drug_discovery_in_Model-driven_architecture.pdf'),
(811, 0, 'Cabinet Tree: an orthogonal enclosure approach to visualizing and exploring big data', 'Treemaps are well-known for visualizing hierarchical data. Most related approaches have been focused on layout algorithms and paid little attention to other display properties and interactions. Furthermore, th...', '', '22 July 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'Yalong Yang, Kang Zhang, Jianrong Wang and Quang Vinh Nguyen', 'files/0/2016/09/11/Cabinet_Tree:_an_orthogonal_enclosure_approach_to_visualizing_and_exploring_big_data.pdf'),
(812, 0, 'Meta-MapReduce for scalable data mining', 'W e h a v e e n t e r e d t h e b i g data age. Knowledge extraction from massive data is becoming more and more urgent. MapReduce provides a feasible framework for programming machine learning algorithms in M...', '', '19 July 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'Xuan Liu, Xiaoguang Wang, Stan Matwin and Nathalie Japkowicz', 'files/0/2016/09/11/Meta-MapReduce_for_scalable_data_mining.pdf'),
(813, 0, 'SOCR data dashboard: an integrated big data archive mashing medicare, labor, census and econometric information', 'Intuitive formulation of informative and computationally-efficient queries on big and complex datasets present a number of challenges. As data collection is increasingly streamlined and ubiquitous, data explor...', '', '17 July 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'Syed S Husain, Alexandr Kalinin, Anh Truong and Ivo D Dinov', 'files/0/2016/09/11/SOCR_data_dashboard:_an_integrated_big_data_archive_mashing_medicare,_labor,_census_and_econometric_information.pdf'),
(814, 0, 'Actionable Knowledge As A Service (AKAAS): Leveraging big data analytics in cloud computing environments', 'Knowledge-as-a service is an emerging research trend that constitutes a promising path for organizations aiming to achieve better customer support and decision-making across a wide range of content providers. ...', '', '16 July 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'Audrey Depeige and Dimitri Doyencourt', 'files/0/2016/09/11/Actionable_Knowledge_As_A_Service_(AKAAS):_Leveraging_big_data_analytics_in_cloud_computing_environments.pdf'),
(815, 0, 'Structural and functional analytics for community detection in large-scale complex networks', 'Community structure is thought to be one of the main organizing principles in most complex networks. Big data and complex networks represent an area which researchers are analyzing worldwide. Of special intere...', '', '8 July 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'Pravin Chopade and Justin Zhan', 'files/0/2016/09/11/Structural_and_functional_analytics_for_community_detection_in_large-scale_complex_networks.pdf'),
(816, 0, 'Performance analysis of concurrent workflows', 'Automated workflows are the key concept of big data pipelines in science, engineering and enterprise applications. The performance analysis of automated workflows is an important topic of the continuous improv...', '', '3 July 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'Andreas Kempa-Liehr', 'files/0/2016/09/11/Performance_analysis_of_concurrent_workflows.pdf'),
(817, 0, 'Sharing big biomedical data', 'The promise of Big Biomedical Data may be offset by the enormous challenges in handling, analyzing, and sharing it. In this paper, we provide a framework for developing practical and reasonable data sharing po...', '', '27 June 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'Arthur W Toga and Ivo D Dinov', 'files/0/2016/09/11/Sharing_big_biomedical_data.pdf'),
(818, 0, 'Summarizing large text collection using topic modeling and clustering based on MapReduce framework', 'Document summarization provides an instrument for faster understanding the collection of text documents and has a number of real life applications. Semantic similarity and clustering can be utilized efficientl...', '', '26 June 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'N K Nagwani', 'files/0/2016/09/11/Summarizing_large_text_collection_using_topic_modeling_and_clustering_based_on_MapReduce_framework.pdf'),
(819, 0, 'Sentiment analysis using product review data', 'Sentiment analysis or opinion mining is one of the major tasks of NLP (Natural Language Processing). Sentiment analysis has gain much attention in recent years. In this paper, we aim to tackle the problem of s...', '', '16 June 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'Xing Fang and Justin Zhan', 'files/0/2016/09/11/Sentiment_analysis_using_product_review_data.pdf'),
(820, 0, 'Paradigm Shift in Big Data SuperComputing: DataFlow vs. ControlFlow', 'The paper discusses the shift in the computing paradigm and the programming model for Big Data problems and applications. We compare DataFlow and ControlFlow programming models through their quantity and quali...', '', '10 May 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'Nemanja Trifunovic, Veljko Milutinovic, Jakob Salom and Anton Kos', 'files/0/2016/09/11/Paradigm_Shift_in_Big_Data_SuperComputing:_DataFlow_vs._ControlFlow.pdf'),
(821, 0, 'Contextual anomaly detection framework for big sensor data', 'The ability to detect and process anomalies for Big Data in real-time is a difficult task. The volume and velocity of the data within many systems makes it difficult for typical algorithms to scale and retain ...', '', '27 February 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'Michael A Hayes and Miriam AM Capretz', 'files/0/2016/09/11/Contextual_anomaly_detection_framework_for_big_sensor_data.pdf'),
(822, 0, 'Intrusion detection and Big Heterogeneous Data: a Survey', 'Intrusion Detection has been heavily studied in both industry and academia, but cybersecurity analysts still desire much more alert accuracy and overall threat analysis in order to secure their systems within ...', '', '27 February 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'Richard Zuech, Taghi M Khoshgoftaar and Randall Wald', 'files/0/2016/09/11/Intrusion_detection_and_Big_Heterogeneous_Data:_a_Survey.pdf'),
(823, 0, 'Deep learning applications and challenges in big data analytics', 'Big Data Analytics and Deep Learning are two high-focus of data science. Big Data has become important as many organizations both public and private have been collecting massive amounts of domain-specific info...', '', '24 February 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'Maryam M Najafabadi, Flavio Villanustre, Taghi M Khoshgoftaar, Naeem Seliya, Randall Wald and Edin Muharemagic', 'files/0/2016/09/11/Deep_learning_applications_and_challenges_in_big_data_analytics.pdf'),
(824, 0, 'DCMS: A data analytics and management system for molecular simulation', 'Molecular Simulation (MS) is a powerful tool for studying physical/chemical features of large systems and has seen applications in many scientific and engineering domains. During the simulation process, the ex...', '', '26 November 2014', 'Journal of Big Data', '0000-00-00 00:00:00', 'Anand Kumar, Vladimir Grupcev, Meryem Berrada, Joseph C Fogarty, Yi-Cheng Tu, Xingquan Zhu, Sagar A Pandit and Yuni Xia', 'files/0/2016/09/11/DCMS:_A_data_analytics_and_management_system_for_molecular_simulation.pdf'),
(825, 0, 'A survey on platforms for big data analytics', 'The primary purpose of this paper is to provide an in-depth analysis of different platforms available for performing big data analytics. This paper surveys different hardware platforms available for big data a...', '', '9 October 2014', 'Journal of Big Data', '0000-00-00 00:00:00', 'Dilpreet Singh and Chandan K Reddy', 'files/0/2016/09/11/A_survey_on_platforms_for_big_data_analytics.pdf'),
(826, 0, 'Cultivating a research agenda for data science', 'I describe a research agenda for data science based on a decade of research and operational work in data-intensive systems at NASA, the University of Southern California, and in the context of open source work...', '', '6 August 2014', 'Journal Of Big Data', '0000-00-00 00:00:00', 'Chris A Mattmann', 'files/0/2016/09/11/Cultivating_a_research_agenda_for_data_science.pdf'),
(827, 0, 'A big data methodology for categorising technical support requests using Hadoop and Mahout', 'Technical Support call centres frequently receive several thousand customer queries on a daily basis. Traditionally, such organisations discard data related to customer enquiries within a relatively short peri...', '', '24 June 2014', 'Journal Of Big Data', '0000-00-00 00:00:00', 'Arantxa Duque Barrachina and Aisling O’Driscoll', 'files/0/2016/09/11/A_big_data_methodology_for_categorising_technical_support_requests_using_Hadoop_and_Mahout.pdf'),
(828, 0, 'Airline new customer tier level forecasting for real-time resource allocation of a miles program', 'This is a case study on an airline’s miles program resource optimization. The airline had a large miles loyalty program but was not taking advantage of recent data mining techniques. As an example, to predict ...', '', '24 June 2014', 'Journal Of Big Data', '0000-00-00 00:00:00', 'Jose Berengueres and Dmitry Efimov', 'files/0/2016/09/11/Airline_new_customer_tier_level_forecasting_for_real-time_resource_allocation_of_a_miles_program.pdf'),
(829, 0, 'A review of data mining using big data in health informatics', 'The amount of data produced within Health Informatics has grown to be quite vast, and analysis of this Big Data grants potentially limitless possibilities for knowledge to be gained. In addition, this informat...', '', '24 June 2014', 'Journal Of Big Data', '0000-00-00 00:00:00', 'Matthew Herland, Taghi M Khoshgoftaar and Randall Wald', 'files/0/2016/09/11/A_review_of_data_mining_using_big_data_in_health_informatics.pdf'),
(830, 0, 'v-TerraFly: large scale distributed spatial data visualization with autonomic resource management', 'GIS application hosts are becoming more and more complicated. Theses hosts’ management is becoming more time consuming and less reliabale decreases with the increase in complexity of GIS applications. The reso...', '', '24 June 2014', 'Journal Of Big Data', '0000-00-00 00:00:00', 'Yun Lu, Ming Zhao, Lixi Wang and Naphtali Rishe', 'files/0/2016/09/11/v-TerraFly:_large_scale_distributed_spatial_data_visualization_with_autonomic_resource_management.pdf'),
(831, 0, 'Comparative study between incremental and ensemble learning on data streams: Case study', 'With unlimited growth of real-world data size and increasing requirement of real-time processing, immediate processing of big stream data has become an urgent problem. In stream data, hidden patterns commonly ...', '', '24 June 2014', 'Journal Of Big Data', '0000-00-00 00:00:00', 'Wenyu Zang, Peng Zhang, Chuan Zhou and Li Guo', 'files/0/2016/09/11/Comparative_study_between_incremental_and_ensemble_learning_on_data_streams:_Case_study.pdf'),
(832, 0, 'Identification of top-K influential communities in big networks', 'Because communities are the fundamental component of big data/large data network graphs, community detection in large-scale graphs is an important area to study. Communities are a collection of a set of nodes ...', '', '8 September 2016', 'Journal of Big Data', '0000-00-00 00:00:00', 'Justin Zhan, Vivek Guidibande and Sai Phani Krishna Parsa', 'files/0/2016/09/11/Identification_of_top-K_influential_communities_in_big_networks.pdf'),
(833, 0, 'Multi-method approach to wellness predictive modeling', 'Patient wellness and preventative care are increasingly becoming a concern for many patients, employers, and healthcare professionals. The federal government has increased spending for wellness alongside new l...', '', '24 August 2016', 'Journal of Big Data', '0000-00-00 00:00:00', 'Ankur Agarwal, Christopher Baechle, Ravi S. Behara and Vinaya Rao', 'files/0/2016/09/11/Multi-method_approach_to_wellness_predictive_modeling.pdf'),
(834, 0, 'Reaping the benefits of big data in telecom', 'We collect big data use cases for a representative sample of telecom companies worldwide and observe a wide and skewed distribution of big data returns, with a few companies reporting large impact for a long t...', '', '28 July 2016', 'Journal of Big Data', '0000-00-00 00:00:00', 'Jacques Bughin', 'files/0/2016/09/11/Reaping_the_benefits_of_big_data_in_telecom.pdf'),
(835, 0, 'Analysis of hourly road accident counts using hierarchical clustering and cophenetic correlation coefficient (CPCC)', 'Road and traffic accidents are an important concern around the world. Road accidents not only affects the public health with different level of injury but also results in property damage. Data analysis has the...', '', '5 July 2016', 'Journal of Big Data', '0000-00-00 00:00:00', 'Sachin Kumar and Durga Toshniwal', 'files/0/2016/09/11/Analysis_of_hourly_road_accident_counts_using_hierarchical_clustering_and_cophenetic_correlation_coefficient_(CPCC).pdf'),
(836, 0, 'Optimized relativity search: node reduction in personalized page rank estimation for large graphs', 'This paper proposes an algorithm called optimized relativity search to reduce the number of nodes in a graph when attempting to decrease the running time for personalized page rank (PPR) estimation. Even thoug...', '', '2 July 2016', 'Journal of Big Data', '0000-00-00 00:00:00', 'Matin Pirouz and Justin Zhan', 'files/0/2016/09/11/Optimized_relativity_search:_node_reduction_in_personalized_page_rank_estimation_for_large_graphs.pdf'),
(837, 0, 'Spatial data extension for Cassandra NoSQL database', 'The big data phenomenon is becoming a fact. Continuous increase of digitization and connecting devices to Internet are making current solutions and services smarter, richer and more personalized. The emergence...', '', '22 June 2016', 'Journal of Big Data', '0000-00-00 00:00:00', 'Mohamed Ben Brahim, Wassim Drira, Fethi Filali and Noureddine Hamdi', 'files/0/2016/09/11/Spatial_data_extension_for_Cassandra_NoSQL_database.pdf'),
(838, 0, 'Towards shortest path identification on large networks', 'The use of Big Data in today’s world has become a necessity due to the massive number of technologies developed recently that keeps on providing us with data such as sensors, surveillance system and even smart...', '', '13 June 2016', 'Journal of Big Data', '0000-00-00 00:00:00', 'Haysam Selim and Justin Zhan', 'files/0/2016/09/11/Towards_shortest_path_identification_on_large_networks.pdf'),
(839, 0, 'A survey of transfer learning', 'Machine learning and data mining techniques have been used in numerous real-world applications. An assumption of traditional machine learning methodologies is the training data and testing data are taken from ...', '', '28 May 2016', 'Journal of Big Data', '0000-00-00 00:00:00', 'Karl Weiss, Taghi M. Khoshgoftaar and DingDing Wang', 'files/0/2016/09/11/A_survey_of_transfer_learning.pdf'),
(840, 0, 'A novel framework to analyze road accident time series data', 'Road accident data analysis plays an important role in identifying key factors associated with road accidents. These associated factors help in taking preventive measures to overcome the road accidents. Variou...', '', '26 May 2016', 'Journal of Big Data', '0000-00-00 00:00:00', 'Sachin Kumar and Durga Toshniwal', 'files/0/2016/09/11/A_novel_framework_to_analyze_road_accident_time_series_data.pdf'),
(841, 0, 'Topic discovery and future trend forecasting for texts', 'Finding topics from a collection of documents, such as research publications, patents, and technical reports, is helpful for summarizing large scale text collections and the world wide web. It can also help fo...', '', '14 April 2016', 'Journal of Big Data', '0000-00-00 00:00:00', 'Jose L. Hurtado, Ankur Agarwal and Xingquan Zhu', 'files/0/2016/09/11/Topic_discovery_and_future_trend_forecasting_for_texts.pdf'),
(842, 0, 'Feasibility analysis of AsterixDB and Spark streaming with Cassandra for stream-based processing', 'For getting up-to-date insight into online services, extracted data has to be processed in near real time. For example, major big data companies (Facebook, LinkedIn, Twitter) analyse streaming data for develop...', '', '8 April 2016', 'Journal of Big Data', '0000-00-00 00:00:00', 'Pekka Pääkkönen', 'files/0/2016/09/11/Feasibility_analysis_of_AsterixDB_and_Spark_streaming_with_Cassandra_for_stream-based_processing.pdf'),
(843, 0, 'Role of big-data in classification and novel class detection in data streams', '“Data streams” is defined as class of data generated over “text, audio and video” channel in continuous form. The streams are of infinite length and may comprise of structured or unstructured data. With these ...', '', '5 March 2016', 'Journal of Big Data', '0000-00-00 00:00:00', 'M. B. Chandak', 'files/0/2016/09/11/Role_of_big-data_in_classification_and_novel_class_detection_in_data_streams.pdf'),
(844, 0, 'An AppGallery for dataflow computing', 'This paper describes the vision behind and the mission of the Maxeler Application Gallery (AppGallery.Maxeler.com) project. First, it concentrates on the essence and performance advantages of the Maxeler dataf...', '', '18 February 2016', 'Journal of Big Data', '0000-00-00 00:00:00', 'Nemanja Trifunovic, Veljko Milutinovic, Nenad Korolija and Georgi Gaydadjiev', 'files/0/2016/09/11/An_AppGallery_for_dataflow_computing.pdf'),
(845, 0, 'Mining Chinese social media UGC: a big-data framework for analyzing Douban movie reviews', 'Analysis of online user-generated content is receiving attention  for its wide applications from both academic researchers and industry stakeholders. In this pilot study, we address common Big Data problems of...', '', '13 January 2016', 'Journal of Big Data', '0000-00-00 00:00:00', 'Jie Yang and Brian Yecies', 'files/0/2016/09/11/Mining_Chinese_social_media_UGC:_a_big-data_framework_for_analyzing_Douban_movie_reviews.pdf'),
(846, 0, 'Data stream clustering by divide and conquer approach based on vector model', 'Recently, many researchers have focused on data stream processing as an efficient method for extracting knowledge from big data. Data stream clustering is an unsupervised approach that is employed for huge dat...', '', '7 January 2016', 'Journal of Big Data', '0000-00-00 00:00:00', 'Madjid Khalilian, Norwati Mustapha and Nasir Sulaiman', 'files/0/2016/09/11/Data_stream_clustering_by_divide_and_conquer_approach_based_on_vector_model.pdf'),
(847, 0, 'Big data, Big bang?', 'Using a random sample consisting of hundreds of companies worldwide, we are testing the impact on company performance of investing in big data projects targeted on three major business domains (namely, custome...', '', '7 January 2016', 'Journal of Big Data', '0000-00-00 00:00:00', 'Jacques Bughin', 'files/0/2016/09/11/Big_data,_Big_bang?.pdf'),
(848, 0, 'The ubiquitous self-organizing map for non-stationary data streams', 'The Internet of things promises a continuous flow of data where traditional database and data-mining methods cannot be applied. This paper presents improvements on the Ubiquitous Self-Organized Map (UbiSOM), a...', '', '14 December 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'Bruno Silva and Nuno Cavalheiro Marques', 'files/0/2016/09/11/The_ubiquitous_self-organizing_map_for_non-stationary_data_streams.pdf'),
(849, 0, 'A data mining framework to analyze road accident data', 'One of the key objectives in accident data analysis to identify the main factors associated with a road and traffic accident. However, heterogeneous nature of road accident data makes the analysis task difficu...', '', '21 November 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'Sachin Kumar and Durga Toshniwal', 'files/0/2016/09/11/A_data_mining_framework_to_analyze_road_accident_data.pdf'),
(850, 0, 'An industrial big data pipeline for data-driven analytics maintenance applications in large-scale smart manufacturing facilities', 'The term smart manufacturing refers to a future-state of manufacturing, where the real-time transmission and analysis of data from across the factory creates manufacturing intelligence, which can be used to ha...', '', '16 November 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'P. O’Donovan, K. Leahy, K. Bruton and D. T. J. O’Sullivan', 'files/0/2016/09/11/An_industrial_big_data_pipeline_for_data-driven_analytics_maintenance_applications_in_large-scale_smart_manufacturing_facilities.pdf'),
(851, 0, 'A survey of open source tools for machine learning with big data in the Hadoop ecosystem', 'With an ever-increasing amount of options, the task of selecting machine learning tools for big data can be difficult. The available tools have advantages and drawbacks, and many have overlapping uses. The wor...', '', '5 November 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'Sara Landset, Taghi M. Khoshgoftaar, Aaron N. Richter and Tawfiq Hasanin', 'files/0/2016/09/11/A_survey_of_open_source_tools_for_machine_learning_with_big_data_in_the_Hadoop_ecosystem.pdf'),
(852, 0, 'Survey of review spam detection using machine learning techniques', 'Online reviews are often the primary factor in a customer’s decision to purchase a product or service, and are a valuable source of information that can be used to determine public opinion on these products or...', '', '5 October 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'Michael Crawford, Taghi M. Khoshgoftaar, Joseph D. Prusa, Aaron N. Richter and Hamzah Al Najada', 'files/0/2016/09/11/Survey_of_review_spam_detection_using_machine_learning_techniques.pdf'),
(853, 0, 'Visualizing Big Data with augmented and virtual reality: challenges and research agenda', 'This paper provides a multi-disciplinary overview of the research issues and achievements in the field of Big Data and its visualization techniques and tools. The main aim is to summarize challenges in visuali...', '', '1 October 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'Ekaterina Olshannikova, Aleksandr Ometov, Yevgeni Koucheryavy and Thomas Olsson', 'files/0/2016/09/11/Visualizing_Big_Data_with_augmented_and_virtual_reality:_challenges_and_research_agenda.pdf'),
(854, 0, 'Big data analytics: a survey', 'The age of big data is now coming. But the traditional data  analytics may not be able to handle such large quantities of data. The question that arises now is, how to develop a high performance <i>platform</i> to effic...', '', '1 October 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'Chun-Wei Tsai, Chin-Feng Lai, Han-Chieh Chao and Athanasios V. Vasilakos', 'files/0/2016/09/11/Big_data_analytics:_a_survey.pdf'),
(855, 0, 'Big data in manufacturing: a systematic mapping study', 'The manufacturing industry is currently in the midst of a data-driven revolution, which promises to transform traditional manufacturing facilities in to highly optimised smart manufacturing facilities. These s...', '', '11 September 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'Peter O’Donovan, Kevin Leahy, Ken Bruton and Dominic T. J. O’Sullivan', 'files/0/2016/09/11/Big_data_in_manufacturing:_a_systematic_mapping_study.pdf'),
(856, 0, 'Erratum to: Structural and functional analytics for community detection in large-scale complex networks', '', '', '25 August 2015', 'Journal of Big Data', '0000-00-00 00:00:00', 'Pravin Chopade and Justin Zhan', 'files/0/2016/09/11/Erratum_to:_Structural_and_functional_analytics_for_community_detection_in_large-scale_complex_networks.pdf'),
(857, 1, 'TGF Sergio', 'Trabajo fin de grado de Sergio Muñoz Gamarra. Desarrollo de un sistema de recomendación de artículos científicos.', '', '11-09-2016', 'ETSIIT', '0000-00-00 00:00:00', 'Sergio Muñoz Gamarra', 'files/1/2016/09/11/TFG_SergioMuñozGamarra2.pdf'),
(858, 2, 'Personalización de Sistemas de Recomendación', 'Abstract del artículo sobre personalización de sistemas de recomendación.', '', '01-04-2015', 'ETSIIT', '0000-00-00 00:00:00', 'Jose Muñoz Gamarra', 'files/2/2016/09/11/fgarcia.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Art_etiq`
--

CREATE TABLE `Art_etiq` (
  `id_art` int(11) NOT NULL,
  `id_etiq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `Art_etiq`
--

INSERT INTO `Art_etiq` (`id_art`, `id_etiq`) VALUES
(857, 43),
(858, 43),
(857, 44),
(858, 44),
(857, 45),
(858, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Etiqueta`
--

CREATE TABLE `Etiqueta` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `Etiqueta`
--

INSERT INTO `Etiqueta` (`id`, `nombre`) VALUES
(28, ''),
(34, 'BANKING'),
(35, 'BIG'),
(1, 'BIG DATA'),
(50, 'CLUSTERING'),
(49, 'COOKBOOK'),
(47, 'DATA'),
(48, 'DUMMIES'),
(42, 'FRAUDE'),
(45, 'HADOOP'),
(39, 'INFORMACIÓN'),
(32, 'INTERES'),
(33, 'INVESTIGACION'),
(44, 'MAHOUT'),
(14, 'Más'),
(18, 'Nueva 1'),
(24, 'NUEVA 3'),
(25, 'NUEVA 5'),
(27, 'Nuevisima'),
(41, 'PRUEBA'),
(10, 'Prueba 1'),
(11, 'Pruebas'),
(43, 'RECOMENDACION'),
(40, 'RECOMENDAR'),
(38, 'RECOMMENDER'),
(3, 'S'),
(37, 'SERGIO'),
(46, 'SOLR'),
(2, 'TELECOM'),
(36, 'TFG'),
(31, 'TRABAJO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Recomendacion`
--

CREATE TABLE `Recomendacion` (
  `IdUsuario` int(11) NOT NULL,
  `IdArticulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `Recomendacion`
--

INSERT INTO `Recomendacion` (`IdUsuario`, `IdArticulo`) VALUES
(1, 813),
(2, 813),
(1, 817),
(2, 817),
(2, 857);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `User_etiq`
--

CREATE TABLE `User_etiq` (
  `id_user` int(11) NOT NULL,
  `id_etiq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `User_etiq`
--

INSERT INTO `User_etiq` (`id_user`, `id_etiq`) VALUES
(11, 34),
(1, 43),
(18, 43),
(1, 44),
(11, 44),
(18, 44),
(1, 45),
(11, 47);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `puesto_trabajo` varchar(255) DEFAULT NULL,
  `organizacion` varchar(255) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`id`, `nombre`, `apellidos`, `email`, `password`, `puesto_trabajo`, `organizacion`, `titulo`) VALUES
(1, 'Sergio', 'Muñoz Gamarra', 'sergiogamarra91@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Creador', 'UGR', 'Ingeneriero Informático'),
(2, 'Jose', 'Muñoz Gamarra', 'prueba@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Investigador', 'UAB', 'Doctor en Microelectrónica'),
(3, 'Ángeles', 'Muñoz Gamarra', 'prueba2@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Investigadora', 'UGR', 'Doctora en Educación Especial'),
(4, 'Pepe', 'Muñoz Gamarra', 'prueba3@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Investigadora', 'UGR', 'Doctora en Educación Especial'),
(11, 'Prueba', 'Registro final', 's@s.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Investigador', 'UGR', 'Graduado en informática'),
(12, 'Administrador', 'ScienceAffinity', 'admin@admin.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrador', 'ScienceAffinity', NULL),
(18, 'Felipe', 'Fernandez', '1@ugr.es', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Profesor', 'UGR', 'Doctor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Votacion`
--

CREATE TABLE `Votacion` (
  `id_usuario` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `puntuacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `Votacion`
--

INSERT INTO `Votacion` (`id_usuario`, `id_articulo`, `fecha`, `puntuacion`) VALUES
(1, 809, '2016-09-11 20:10:29', 5),
(1, 810, '2016-09-11 20:10:29', 4),
(1, 811, '2016-09-11 20:10:29', 5),
(1, 812, '2016-09-11 20:10:29', 5),
(1, 822, '0000-00-00 00:00:00', 5),
(1, 857, '2016-09-11 20:11:24', 5),
(1, 858, '0000-00-00 00:00:00', 5),
(2, 809, '2016-09-11 20:10:29', 5),
(2, 810, '2016-09-11 20:10:29', 5),
(2, 811, '2016-09-11 20:10:29', 5),
(2, 812, '2016-09-11 20:11:24', 0),
(2, 822, '2016-09-11 21:14:29', 4),
(2, 825, '2016-09-11 20:15:19', 4),
(2, 858, '2016-09-11 21:10:44', 0),
(4, 809, '2016-09-11 20:10:29', 5),
(4, 810, '2016-09-11 20:10:29', 4),
(4, 811, '2016-09-11 20:10:29', 5),
(4, 812, '2016-09-11 20:10:29', 5),
(4, 813, '2016-09-11 21:15:19', 5),
(4, 817, '2016-09-11 21:20:22', 4),
(4, 822, '0000-00-00 00:00:00', 5),
(4, 857, '2016-09-11 20:11:24', 5),
(11, 809, '2016-09-11 20:10:29', 5),
(11, 810, '2016-09-11 20:10:29', 4),
(11, 811, '2016-09-11 20:10:29', 5),
(11, 815, '2016-09-11 20:15:19', 5),
(11, 830, '2016-09-11 20:11:24', 5),
(11, 831, '2016-09-11 20:11:24', 5),
(11, 840, '2016-09-11 21:14:29', 5),
(11, 848, '2016-09-11 21:12:28', 5),
(11, 857, '0000-00-00 00:00:00', 5),
(12, 809, '2016-09-11 20:10:29', 5),
(12, 810, '2016-09-11 20:10:29', 4),
(12, 811, '2016-09-11 20:10:29', 5),
(12, 812, '2016-09-11 20:10:29', 5),
(12, 813, '2016-09-11 21:15:19', 5),
(12, 817, '2016-09-11 21:20:22', 4),
(12, 822, '0000-00-00 00:00:00', 5),
(12, 828, '2016-09-11 21:17:56', 4),
(12, 837, '2016-09-11 21:17:15', 5),
(12, 857, '2016-09-11 20:11:24', 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Articulo`
--
ALTER TABLE `Articulo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Art_etiq`
--
ALTER TABLE `Art_etiq`
  ADD PRIMARY KEY (`id_art`,`id_etiq`),
  ADD KEY `ident_etiqueta_idx` (`id_etiq`);

--
-- Indices de la tabla `Etiqueta`
--
ALTER TABLE `Etiqueta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `Recomendacion`
--
ALTER TABLE `Recomendacion`
  ADD PRIMARY KEY (`IdUsuario`,`IdArticulo`),
  ADD KEY `id_recomendacion_articulo_idx` (`IdArticulo`);

--
-- Indices de la tabla `User_etiq`
--
ALTER TABLE `User_etiq`
  ADD PRIMARY KEY (`id_user`,`id_etiq`),
  ADD KEY `id_etiqueta_user_idx` (`id_etiq`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Votacion`
--
ALTER TABLE `Votacion`
  ADD PRIMARY KEY (`id_usuario`,`id_articulo`),
  ADD KEY `id_art_vota_idx` (`id_articulo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Articulo`
--
ALTER TABLE `Articulo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=859;
--
-- AUTO_INCREMENT de la tabla `Etiqueta`
--
ALTER TABLE `Etiqueta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Art_etiq`
--
ALTER TABLE `Art_etiq`
  ADD CONSTRAINT `ident_articulo` FOREIGN KEY (`id_art`) REFERENCES `Articulo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ident_etiqueta` FOREIGN KEY (`id_etiq`) REFERENCES `Etiqueta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Recomendacion`
--
ALTER TABLE `Recomendacion`
  ADD CONSTRAINT `id_recomendacion_articulo` FOREIGN KEY (`IdArticulo`) REFERENCES `Articulo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_recomendacion_usuario` FOREIGN KEY (`IdUsuario`) REFERENCES `Usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `User_etiq`
--
ALTER TABLE `User_etiq`
  ADD CONSTRAINT `id_etiqueta_user` FOREIGN KEY (`id_etiq`) REFERENCES `Etiqueta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_usario_etiqueta_user` FOREIGN KEY (`id_user`) REFERENCES `Usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Votacion`
--
ALTER TABLE `Votacion`
  ADD CONSTRAINT `id_art_vota` FOREIGN KEY (`id_articulo`) REFERENCES `Articulo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_usuario_vota` FOREIGN KEY (`id_usuario`) REFERENCES `Usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
