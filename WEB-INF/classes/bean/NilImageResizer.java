package bean;


import java.awt.image.BufferedImage;
import java.awt.image.Raster;
import java.awt.image.WritableRaster;
import java.io.File;
import java.io.IOException;

import javax.imageio.ImageIO;


public class NilImageResizer 
{
	/**FUNCTION FOR IMAGE RESIZE
		arguments
		*1 source File name With complete Path
		*2 destination File name With Complete Path
		*3 resize on Height or width
		*4 size of image Height or Width
	*/
	public void imageResizer(String srcImgName, String dstImgName,String reSizeOn, int size)
	{	
		//System.out.println("size="+size);
		//System.out.println("reSizeOn="+reSizeOn);
		String imgOutputFormat="jpg";
		BufferedImage srcImg = null, dstImg = null;
		try
		{
			srcImg = ImageIO.read(new File(srcImgName));
			dstImg = resizeImage(srcImg,reSizeOn,size);
			ImageIO.write(dstImg, imgOutputFormat, new File(dstImgName));
		}
		catch (IOException IOex)
		{
			IOex.printStackTrace();
		}catch(Exception e)
		{
			e.printStackTrace();
			System.out.println(e.getMessage());
		}
	}
	/**
	* Resizes the image according to the given scaling factors.
	* @param srcImg the image to be resized
	* @return resized image
	*/
	public BufferedImage resizeImage(BufferedImage srcImg,String reSizeOn,int size)
	{
		// get image dimensions
		int srcW = srcImg.getWidth();
		int srcH = srcImg.getHeight();
		//float ratio=0;
		float ratio=(float)0.0;
		if(reSizeOn.equalsIgnoreCase("width"))
		{	
			ratio=(float)size/srcW;
		}else if(reSizeOn.equalsIgnoreCase("height"))
		{
			ratio=(float)size/srcH;
		}	
		System.out.println("ratio="+ratio);
		int dstW = (int) (srcW *ratio);
		int dstH = (int) (srcH* ratio);
		System.out.println("srcW="+srcW+"  srcH="+srcH+"  dstW="+dstW+"    dstH"+dstH+"     ratio="+ratio );
		// Get data structures
		BufferedImage dstImg = new BufferedImage(dstW, dstH, srcImg.getType());
		Raster srcRaster = srcImg.getRaster();
		WritableRaster dstRaster = dstImg.getRaster();
		double[] tmpPix = {0, 0, 0};

		// resize image
		try
		{
		if(reSizeOn.equalsIgnoreCase("width"))
		{	
			for (int y=0; y<dstH; y++)
			{
				for (int x=0; x<dstW; x++) 
				{
					int xPos = (int) (x * (1/ratio)); // (find corresponding src x pos)
					int yPos = (int) (y * (1/ratio)); // (find corresponding src y pos)
					tmpPix = srcRaster.getPixel(xPos, yPos, tmpPix);
					dstRaster.setPixel(x, y, tmpPix);
				}
			}	
		}else if(reSizeOn.equalsIgnoreCase("height"))
		{
			for (int x=0; x<dstW; x++) 
			{
				for (int y=0; y<dstH; y++) 
				{
					int xPos = (int) (x * (1/ratio)); // (find corresponding src x pos)
					int yPos = (int) (y * (1/ratio)); // (find corresponding src y pos)
					tmpPix = srcRaster.getPixel(xPos, yPos, tmpPix);
					dstRaster.setPixel(x, y, tmpPix);
				}
			}
		}
		
		
		}catch(ArrayIndexOutOfBoundsException aex)
		{
			aex.printStackTrace();
			System.out.println(aex.getMessage());
		}catch(NegativeArraySizeException nex)
		{
			System.out.print(nex.getMessage());
		}catch(Exception e)
		{
			e.printStackTrace();
			System.out.println(e.getMessage());
		}
		return dstImg;
	}
}
