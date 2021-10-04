using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;
using System.Data.SqlClient;
using System.Configuration;
namespace WebApplication1.CaseWhen
{
    public partial class WebForm1 : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            if (!IsPostBack)
            {
                using (SqlConnection conn = new SqlConnection(ConfigurationManager.ConnectionStrings["connDB"].ConnectionString))
                {
                    SqlCommand cmd = new SqlCommand();
                    cmd.CommandType = CommandType.Text;
                    cmd.CommandText = "select avg(notafinal) as Media_Nota, case departamento when '02' then 'LA PAZ' when '03' then 'COCHABAMBA' when '04' then 'ORURO' end as Departamento from notas group by departamento;";
                    cmd.Connection = conn;
                    conn.Open();
                    notas.DataSource = cmd.ExecuteReader();
                    notas.DataBind();

                }
            }

        }
    }
}