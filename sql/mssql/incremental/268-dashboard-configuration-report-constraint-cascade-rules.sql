
UPDATE EASOL.DashboardConfiguration SET LeftChartReportId = NULL WHERE DashboardConfigurationId IN 
  (SELECT DashboardConfigurationId FROM EASOL.DashboardConfiguration 
    LEFT JOIN EASOL.Report ON EASOL.Report.ReportId = EASOL.DashboardConfiguration.LeftChartReportId
    WHERE EASOL.Report.ReportId IS NULL);

UPDATE EASOL.DashboardConfiguration SET RightChartReportId = NULL WHERE DashboardConfigurationId IN 
  (SELECT DashboardConfigurationId FROM EASOL.DashboardConfiguration 
    LEFT JOIN EASOL.Report ON EASOL.Report.ReportId = EASOL.DashboardConfiguration.RightChartReportId
    WHERE EASOL.Report.ReportId IS NULL);

UPDATE EASOL.DashboardConfiguration SET BottomTableReportId = NULL WHERE DashboardConfigurationId IN 
  (SELECT DashboardConfigurationId FROM EASOL.DashboardConfiguration 
    LEFT JOIN EASOL.Report ON EASOL.Report.ReportId = EASOL.DashboardConfiguration.BottomTableReportId
    WHERE EASOL.Report.ReportId IS NULL);



BEGIN TRY
    ALTER TABLE [EASOL].[DashboardConfiguration] DROP CONSTRAINT [FK__Dashboard__Right__5F1F0650];
END TRY
BEGIN CATCH
END CATCH

BEGIN TRY
    ALTER TABLE [EASOL].[DashboardConfiguration] DROP CONSTRAINT [FK_DashboardConfiguration_RightChartReportId];
END TRY
BEGIN CATCH
END CATCH

BEGIN TRY
    ALTER TABLE [EASOL].[DashboardConfiguration] DROP CONSTRAINT [FK_DashboardConfiguration_LeftChartReportId];
END TRY
BEGIN CATCH
END CATCH

BEGIN TRY
    ALTER TABLE [EASOL].[DashboardConfiguration] DROP CONSTRAINT [FK_DashboardConfiguration_BottomTableReportId];
END TRY
BEGIN CATCH
END CATCH


ALTER TABLE [EASOL].DashboardConfiguration
   ADD CONSTRAINT [FK_DashboardConfiguration_LeftChartReportId]
   FOREIGN KEY ([LeftChartReportId])
   REFERENCES [EASOL].[Report](ReportId) ON UPDATE NO ACTION ON DELETE NO ACTION;


ALTER TABLE [EASOL].DashboardConfiguration
 ADD CONSTRAINT FK_DashboardConfiguration_RightChartReportId
 FOREIGN KEY (RightChartReportId)
 REFERENCES [EASOL].[Report](ReportId) ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE [EASOL].DashboardConfiguration
 ADD CONSTRAINT FK_DashboardConfiguration_BottomTableReportId
 FOREIGN KEY (BottomTableReportId)
 REFERENCES [EASOL].[Report](ReportId) ON UPDATE NO ACTION ON DELETE NO ACTION;



CREATE TRIGGER DeleteReportIdTrigger
    ON EASOL.Report
INSTEAD OF DELETE
  AS
    BEGIN
      UPDATE EASOL.DashboardConfiguration SET LeftChartReportId = NULL
      WHERE LeftChartReportId IN (SELECT deleted.ReportId FROM deleted);
      UPDATE EASOL.DashboardConfiguration SET RightChartReportId = NULL
      WHERE RightChartReportId IN (SELECT deleted.ReportId FROM deleted);
      UPDATE EASOL.DashboardConfiguration SET BottomTableReportId = NULL
      WHERE BottomTableReportId IN (SELECT deleted.ReportId FROM deleted);
      DELETE FROM EASOL.Report WHERE ReportId IN (SELECT deleted.ReportId FROM deleted);
    END





