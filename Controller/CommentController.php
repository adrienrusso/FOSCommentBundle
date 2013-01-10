<?php

/**
 * This file is part of the FOSCommentBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace FOS\CommentBundle\Controller;

use FOS\CommentBundle\Model\CommentInterface;
use FOS\CommentBundle\Model\ThreadInterface;
use FOS\Rest\Util\Codes;
use FOS\RestBundle\View\RouteRedirectView;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Templating\TemplateReference;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Restful controller for the Threads.
 *
 * @author Alexander <iam.asm89@gmail.com>
 */
class CommentController extends Controller
{
    public function moderateAction()
    {
        $request = $this->getRequest();
        $displayDepth = $request->query->get('displayDepth');
        $sorter = $request->get('sorter');
        $comments = $this->container->get('fos_comment.manager.comment')->findCommentsByState(CommentInterface::STATE_PENDING, $displayDepth, $sorter);

        return $this->container->get('templating')->renderResponse(
            'FOSCommentBundle:Comment:moderate.html.twig',
            array(
                'comments' => $comments,
                'displayDepth' => $displayDepth,
                'sorter' => 'date',
            )
        );
    }
}
