SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [EASOL].[Logs](
	[LogId] [int] IDENTITY(1,1) NOT NULL,
	[StaffUSI] [int] NOT NULL,
	[DateTime] [datetime] NOT NULL,
	[IpAddress] [nvarchar](16) NOT NULL,
	[Description] [nvarchar](255) NOT NULL,
	[Controller] [nvarchar](75) NOT NULL,
	[Method] [nvarchar](75) NOT NULL,
	[Object] [nvarchar](75) NULL,
	[Data] [text] NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

